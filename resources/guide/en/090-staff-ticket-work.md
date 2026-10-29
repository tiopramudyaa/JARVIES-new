---
key: staff-ticket-work
chapter: tickets
order: 90
title: Work a ticket as Super Admin
summary: Change the status of a ticket and run a meeting from the portal.
requires: ["@staff"]
updated: 2026-10-29
---
Super Admin accounts see two extra tools on a ticket: the status panel and the meeting button.

## Who uses this

Super Admin accounts only.

## Before you start

Changing the status is visible to the customer and is recorded in the ticket. Choose the status that is true, because the customer reads it.

## Step by step

### Change the status

1. Open the ticket and look at the properties panel.
2. Under `Status`, choose one value: `Open`, `In Process`, `Waiting on Customer`, `Waiting on 3rd Party`, `Waiting Confirmation`, `Hold`, `Cancelled` or `Closed`.
3. Select `Kirim` to save. See [[ticket-statuses]] for what each value means.

### Run a meeting

1. In the reply area, select `Meeting`.
2. In `Start Meeting?`, paste the meeting link if you have one. It is optional, and Zoom, Google Meet and Teams links are recognised.
3. Select `Start Meeting`. The customer sees a `Meeting Started` card with a `Join Meeting` link, and the SLA clock pauses.
4. When you finish, the button reads `End Meeting`. Confirm with `End Meeting`. The customer sees `Meeting Ended` with the duration.

## What happens next

Meeting time is recorded as waiting hours and does not count toward the SLA resolution time. The customer is notified of status changes.

## Common questions

**I do not see the `Meeting` button.** It is limited to Super Admin accounts.

<!-- sources: resources/views/tickets/show.blade.php, app/Http/Controllers/TicketController.php -->
