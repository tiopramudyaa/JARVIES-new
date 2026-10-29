---
key: close-ticket
chapter: tickets
order: 80
title: Close a ticket
summary: Tell the support team that your issue is solved by closing the ticket.
requires: ["@customer"]
updated: 2026-10-29
---
Closing a ticket tells Eclectic that your issue is resolved. It is the last step of every ticket.

## Who uses this

Customers.

## Before you start

- Close the ticket only when your issue is solved. The conversation and files stay readable afterwards.
- Check the deliverables first, if the ticket has any. See [[ticket-detail]].

## Step by step

1. Open the ticket.
2. In the properties panel, under `Actions`, select `Close Ticket`.
3. Read `Close This Ticket?`. It says that closing indicates your issue has been resolved and that a confirmation email will be sent to you.
4. Select `Confirm`.

## What happens next

The status becomes `Closed`, a line about it is added to the conversation, and you get a confirmation email. The `Close Ticket` button disappears. The deliverable folder, if any, stays available.

## Common questions

**I do not see `Close Ticket`.** The ticket is already closed or cancelled.

**It says `Ticket is already closed`.** Someone else closed it a moment before. Refresh the page.

**I closed it by mistake.** Contact the helpdesk and mention the ticket number.

<!-- sources: resources/views/tickets/show.blade.php, app/Http/Controllers/TicketController.php -->
