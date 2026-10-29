---
key: submission-history
chapter: tickets
order: 45
title: Submission History
summary: Follow whether Eclectic has approved or rejected the tickets you sent.
requires: ["@customer"]
updated: 2026-10-29
---
`Submission History` lists every ticket you sent and whether Eclectic has validated it. A ticket gets its number only after approval.

## Who uses this

Customers.

## Before you start

You see your own submissions. A company admin sees the submissions of the whole company. Group members do not see each other's submissions here.

## Step by step

![Submission History with a pending, an approved and a rejected submission](images/guide/jarvies-submission-history.png)

*Screenshot with sample data.*

1. Open `Tickets`, then select `Submission History` at the top right.
2. Read each row: the description, the status, the date and the priority.
3. Act on the status:
   - `Pending Validation`: Eclectic has not reviewed it yet. Select the row to read what you sent.
   - `Approved`: the ticket exists. Select `View Ticket` to open it.
   - `Rejected`: the row shows the reason. Fix what the reason points to and send a new ticket.
4. Select `Back to Tickets` to return.

## What happens next

An approved ticket moves to the `Tickets` list with its own number and status. A rejected one stays here as a record.

## Common questions

**It says `No pending tickets`.** All your submissions were processed. Look in `Tickets`.

**My ticket stays in `Pending Validation` for a long time.** Eclectic validates tickets by hand. Contact the helpdesk if it is urgent.

<!-- sources: resources/views/tickets/pending.blade.php, app/Http/Controllers/TicketController.php -->
