<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'ticket';
    protected $primaryKey = 'ticket_id';

    protected $fillable = [
        'ticket_number',
        'customer_id',
        'end_customer_id',
        'employee_id',
        'description',
        'start_date',
        'end_date',
        'ticket_priority',
        'ticket_type',
        'status',
        'wait_close',
        'folder',
        'file_log',
        'man_days',
        'channel',
        'email_thread_id',
        'customer_thread_id',
        'cc_emails',
        'last_message_at',
        'last_agent_reply_at',
        'submitted_by_email',
        'submitted_by_name',
    ];

    protected $casts = [
        'start_date'      => 'date',
        'end_date'        => 'date',
        'man_days'        => 'decimal:2',
        'wait_close'      => 'decimal:2',
        'last_message_at' => 'datetime',
        'cc_emails'       => 'array',
        'visible_to_customer' => 'boolean',
    ];

    /**
     * Batasi query ke tiket yang boleh dilihat customer.
     *
     * EcoSystem & JARVIES berbagi tabel `ticket` yang sama, jadi tiket yang
     * dibuat internal dari EcoSystem (Admin / Helpdesk / External API) ikut
     * ter-scope ke `customer_id` company dan akan tampil di JARVIES bila tidak
     * disaring. Dua kolom penandanya di-set dari EcoSystem, JARVIES hanya membaca:
     *
     *   visible_to_customer = 0 → tiket internal EcoSystem
     *   is_hidden           = 1 → di-hide manual lewat menu Hidden Tickets
     *
     * WAJIB dipakai di SEMUA query tiket yang hasilnya dikembalikan ke customer
     * (role 3) — list, detail, statistik, dashboard, dan API mobile.
     *
     * Bukan global scope: JARVIES juga melayani role admin/employee yang justru
     * harus tetap melihat seluruh tiket.
     */
    public function scopeVisibleToCustomer($query)
    {
        return $query->where('visible_to_customer', 1)->whereNull('is_hidden');
    }

    /**
     * Versi per-instance dari scopeVisibleToCustomer() — untuk guard akses satu
     * tiket yang sudah terlanjur di-fetch (mis. Ticket::findOrFail()).
     */
    public function isVisibleToCustomer(): bool
    {
        return (bool) $this->visible_to_customer && !$this->is_hidden;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function endCustomer()
    {
        return $this->belongsTo(Customer::class, 'end_customer_id', 'customer_id');
    }

    // Relasi ke Employee (PIC - Person In Charge)
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function ticketMembers()
    {
        return $this->hasMany(TicketMember::class, 'ticket_id', 'ticket_id');
    }

    public function confirmation()
    {
        return $this->hasOne(TicketConfirmation::class, 'ticket_id', 'ticket_id')
            ->latest();
    }

    public function mandaysHistory()
    {
        return $this->hasMany(MandaysHistory::class, 'ticket_id', 'ticket_id')
            ->orderBy('created_at', 'desc');
    }


    // Relasi Many-to-Many ke Employee (Support Members/Pendamping)
    public function members()
    {
        return $this->belongsToMany(
            Employee::class,
            'ticket_member',
            'ticket_id',
            'employee_id',
            'ticket_id',
            'employee_id'
        )->withTimestamps();
    }

    // Scope untuk filter berdasarkan status
    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

    // Scope untuk filter berdasarkan priority
    public function scopeHighPriority($query)
    {
        return $query->where('ticket_priority', 'High');
    }

    // Accessor untuk status label
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'open'                    => 'Open',
            'inprocess'               => 'In Process',
            'waiting_on_customer'     => 'Waiting on Customer',
            'waiting_on_3rd_party'    => 'Waiting on 3rd Party',
            'waiting_to_confirmation' => 'Waiting to Confirmation',
            'hold'                    => 'Hold',
            'cancelled'              => 'Cancelled',
            'closed'                 => 'Closed',
            default                  => ucfirst($this->status ?? 'Unknown'),
        };
    }

    // Accessor untuk priority badge color
    public function getPriorityColorAttribute()
    {
        return match($this->ticket_priority) {
            'Low' => 'gray',
            'High' => 'red',
            'Medium' => 'blue',
            default => 'gray'
        };
    }

    // Relasi ke pesan-pesan tiket
    public function messages()
    {
        return $this->hasMany(TicketMessage::class, 'ticket_id', 'ticket_id')
            ->orderBy('created_at', 'asc');
    }

    // Relasi ke Delivery Support melalui activities
    public function deliverySupportActivities()
    {
        return $this->hasMany(DeliverySupportActivity::class, 'ticket_id', 'ticket_id');
    }

    // Get delivery supports via activities
    public function deliverySupports()
    {
        return DeliverySupport::whereHas('activities', function ($query) {
            $query->where('ticket_id', $this->ticket_id);
        });
    }
}