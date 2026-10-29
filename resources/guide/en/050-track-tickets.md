---
key: track-tickets
chapter: tickets
order: 50
title: Track your tickets
summary: Find a ticket in the list with the status cards, filters and sorting.
requires: []
updated: 2026-10-29
---
The `Tickets` page lists every ticket you can see. Use it to find a ticket and to check its status.

## Who uses this

Everyone who signs in.

## Before you start

What you see depends on your access:

- A **company admin** sees all tickets of the company, and can switch between `My Tickets` and `All Tickets`.
- A **member** sees the tickets they submitted, plus tickets of colleagues in the same contact group.
- A member who is the **PIC** of a delivery support also sees the tickets of that support, and can switch between `My Tickets` and `All Tickets`.

## Step by step

![The Tickets page with status cards and the ticket list](images/guide/jarvies-tickets.png)

*Screenshot with sample data.*

1. Open `Tickets` from the menu.
2. Under `Status Info`, the cards count your tickets per status. Select a card to filter the list. Select `Total` to see everything.
3. If you see the `My Tickets` and `All Tickets` switch, choose the scope you want.
4. Use the column headers:
   - `Last Update`: select it to sort by the latest activity.
   - `Ticket`: sort, or type part of the ticket number.
   - `Description`: type a keyword.
   - `Delivery`: choose `From` and `To` dates, then `Apply`.
   - `Status`, `Priority`, `Type`, `Man Days`: filter by value.
   - `Created By`: type a name or email.
5. Select `Clear All Filters` to start again.
6. Select a row to open the ticket. See [[ticket-detail]].
7. Use the page arrows at the bottom to move through the list. Each page shows 20 tickets.

## What happens next

A row with a blue background means the support team replied and you have not opened it yet. Opening it clears the mark.

A ticket you sent that Eclectic has not validated yet also appears in the list. It shows `(initial)` as its number and `Awaiting Validation` as its status, and gets a real number after approval. See [[ticket-statuses]].

## Common questions

**A colleague's ticket does not show.** Members see their own tickets and those of their contact group. Ask your company admin.

**The list is empty.** Clear the filters. If it is still empty, you have no tickets yet.

**Where is a ticket I just sent?** It is in `Submission History` until Eclectic approves it. See [[troubleshooting]].

<!-- sources: resources/views/tickets/index.blade.php, app/Http/Controllers/Concerns/ScopesCustomerTickets.php -->
