---
key: dashboard
chapter: getting-started
order: 30
title: Dashboard
summary: Read the ticket numbers, the 30 day trend and your latest tickets at a glance.
requires: []
updated: 2026-10-29
---
The `Dashboard` is the first page after you sign in. It summarises the tickets you are allowed to see.

## Who uses this

Everyone who signs in. The numbers follow the same visibility as the ticket list. See [[track-tickets]].

## Before you start

- The numbers cover only tickets you can see. A member of a company sees fewer tickets than a company admin.
- Internal tickets of Eclectic and hidden tickets are never counted.

## Step by step

![The Dashboard with status cards, the 30 day chart and recent tickets](images/guide/jarvies-dashboard.png)

*Screenshot with sample data.*

1. Read the eight cards at the top: `Total`, `Open`, `In Process`, `Wait Customer`, `Wait 3rd Party`, `Wait Confirm`, `Hold` and `Closed`.
2. Read the `Ticket Submissions` chart. It shows how many tickets were started on each of the last 30 days.
3. Read `Recent Tickets`. It lists your five newest tickets with the number, status and age. Select one to open it, or `View all` to open the ticket list.
4. Use the quick actions at the bottom: `New Ticket`, `My Tickets` and `My Profile`. `New Ticket` is also at the top right.

## What happens next

The numbers refresh every time you open the page. Nothing changes in your tickets by reading it.

## Common questions

**The `Open` card on the Dashboard is bigger than the `Open` card on the Tickets page.** On the Dashboard, `Open` counts every ticket that is not closed or cancelled. On the Tickets page, `Open` counts only tickets whose status is exactly `Open`. See [[ticket-statuses]].

**The cards show zero.** You have no tickets yet, or none that you may see. Select `New Ticket` to send your first.

<!-- sources: app/Http/Controllers/DashboardController.php, resources/views/dashboard.blade.php -->
