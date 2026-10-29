---
key: ticket-statuses
chapter: reference
order: 200
title: Statuses, types and priorities
summary: What each ticket status, type, scale and priority means, and what you should do.
requires: []
updated: 2026-10-29
---
Every ticket has a status, a priority, a type and a scale. This page explains each value and what you should do.

## Who uses this

Everyone who signs in.

## Before you start

The support team sets the status. Customers set the priority, type and scale when they send the ticket, and can close their own ticket with `Close Ticket` on the ticket page.

## Statuses

| Status | Meaning | What you do |
|---|---|---|
| `Awaiting Validation` | Eclectic has not reviewed your submission yet. It has no number yet and shows `(initial)`. | Wait. Read it in `Submission History`. |
| `Open` | The ticket is received and waits to be worked on. | Wait, or add details by replying. |
| `In Process` | A consultant is working on it. | Reply if you have new information. |
| `Waiting on Customer` | The team needs something from you. | Answer the question in the ticket. |
| `Waiting on 3rd Party` | The team waits for another party, for example a vendor. | Wait. |
| `Waiting Confirmation` | The team believes it is solved and asks you to confirm. | Check the result, then close the ticket or reply. |
| `Hold` | Work is paused. | Wait for the team to resume, or ask why. |
| `Closed` | The ticket is finished. | Nothing. |
| `Cancelled` | The ticket was cancelled. | Send a new ticket if you still need help. |

## Priorities

`Very High`, `High`, `Medium` and `Low`. `Medium` is the default. Choose a higher priority only when the issue blocks your work, so the team can order its work well.

## Types and scale

You choose these when you create a ticket. Both are optional.

- `Incident`: something that used to work and now does not.
- `Service Request`: a standard request for something new.
- `Change Request`: a change to how your system works.
- `Consult`: a question or advice.
- `Scale`: `Simple`, `Medium` or `Complex`, your estimate of how big the work is.

## What happens next

The status and priority show in the ticket list and in the ticket page. Use the cards on the `Tickets` page to see how many tickets are in each status. See [[track-tickets]].

## Common questions

**The Dashboard and the Tickets page show different `Open` numbers.** On the Dashboard, `Open` counts everything that is not closed or cancelled. On the Tickets page, it counts only the status `Open`.

**Can I change a status?** Only to close your own ticket. The other statuses are set by the team.

<!-- sources: resources/views/tickets/create.blade.php, resources/views/tickets/show.blade.php, resources/views/dashboard.blade.php, resources/views/tickets/index.blade.php -->
