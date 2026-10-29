---
key: create-ticket
chapter: tickets
order: 40
title: Create a ticket
summary: Send a new support request with details, CC recipients and attachments.
requires: ["@customer"]
updated: 2026-10-29
---
A ticket is a support request. Eclectic reviews each new ticket before it enters the support queue.

## Who uses this

Customers. If your company has end customers, a `Ticket For` field appears at the top of the form. Choose the end customer there.

## Before you start

- Prepare a short, clear subject and a description with what happened, what you expected and any error text.
- Gather screenshots or files you want to share.

## Step by step

![The New Support Ticket form with subject, type, scale, priority and details filled in](images/guide/jarvies-create-ticket.png)

*Screenshot with sample data.*

1. Select `New Ticket` on the `Dashboard`, or on the `Tickets` page.
2. Type the `Subject`. It is required, with at least 5 characters.
3. Fill the optional fields if they help: `Name` and `No HP` of the contact person, `Module`, and `Client`.
4. Choose a `Ticket Type`: `Incident`, `Service Request`, `Change Request` or `Consult`. Choose a `Scale`: `Simple`, `Medium` or `Complex`.
5. Choose the `Priority`: `Very High`, `High`, `Medium` or `Low`. `Medium` is the default.
6. To copy colleagues, select `Add CC` and type each email address. You can add up to 10, and each address must be unique.
7. Write the `Details`. They are required, with at least 10 characters. You can format the text and paste images straight into the editor.
8. To attach files, select `Add File`. You can add up to 10 files of 20 MB each: images, PDF, Word, Excel, PowerPoint, ZIP, text and CSV.
9. Select `Submit Ticket`.

To leave without sending, select `Discard` and confirm. Unsaved changes are lost.

## What happens next

The portal shows `Ticket Submitted Successfully` and a confirmation email goes to your registered address. The ticket is pending Eclectic's review, and you can follow it in `Submission History`. See [[submission-history]]. After approval it becomes a normal ticket with a number, and you reply to it as in [[ticket-chat]]. In some cases the ticket is created straight away and the portal shows `Ticket Created Successfully` instead.

## Common questions

**It says `Subject Too Short` or `Details Required`.** The subject needs at least 5 characters and the details at least 10.

**A file was not added.** It is larger than 20 MB, or you reached 10 files. Reduce or compress the file.

**It says `Rate Limit Reached`.** You sent several tickets in a short time. Wait a moment and try again.

**It says `Email Delivery Failed`.** The ticket was saved but the confirmation email could not be sent. Contact support so they can confirm it.

<!-- sources: resources/views/tickets/create.blade.php, app/Http/Controllers/TicketController.php -->
