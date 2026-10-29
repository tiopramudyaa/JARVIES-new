---
key: tickets-for-end-customers
chapter: tickets
order: 46
title: Tickets for end customers
summary: Send a ticket on behalf of one of the end customers of your company.
requires: ["@parent-customer"]
updated: 2026-10-29
---
If your company is a parent customer with end customers under it, each ticket must say which end customer it is for.

## Who uses this

Customer accounts of a parent customer. If you do not see the `Ticket For` field, your company has no end customers.

## Before you start

The ticket stays under your own account. The choice only tells Eclectic which end customer the work is for.

## Step by step

1. Open `New Ticket`. See [[create-ticket]] for the other fields.
2. At the top, the blue box says that you are submitting on behalf of an end customer.
3. In `Ticket For`, choose the end customer from `Select end customer`. It is required.
4. Fill the rest of the form and select `Submit Ticket`.

## What happens next

In the ticket, the line `For End Customer` shows who it was for. You find the ticket in your own list.

## Common questions

**It says `End Customer Required`.** Choose an end customer in `Ticket For` first.

**The end customer I need is missing.** Contact the RPMO team to add it.

<!-- sources: resources/views/tickets/create.blade.php, resources/views/tickets/show.blade.php, app/Http/Controllers/AuthController.php -->
