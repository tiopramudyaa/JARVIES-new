---
key: ticket-detail
chapter: tickets
order: 60
title: Read a ticket
summary: Understand the conversation, the properties panel and the deliverable folder of a ticket.
requires: []
updated: 2026-10-29
---
The ticket page has the conversation on the left and the properties on the right. Open it by selecting a ticket in the list, in `Recent Tickets`, or in a notification.

## Who uses this

Everyone who signs in.

## Before you start

You can open only tickets you are allowed to see. See [[track-tickets]].

## Step by step

![A ticket page with the ticket list on the left, the conversation in the middle and the properties panel on the right](images/guide/jarvies-ticket-detail.png)

*Screenshot with sample data.*

1. On the left, under `Back to Tickets`, the list of your tickets stays visible. Use `Search tickets…` to find one, and select another ticket to switch without going back to the list. Select `Back to Tickets` to return to the full list.
2. Read the header: the subject, the ticket number, the ticket type and who created it with the date. Times are in WIB.
3. Read the conversation in the middle. It holds your messages, replies of the support team, and system lines such as status changes. Meeting cards appear here too. See [[ticket-chat]].
4. Open the properties panel with the button at the top right of the header. It shows:
   - `Status`, `Priority` and `Ticket Type`. See [[ticket-statuses]].
   - `Man Days`: the approved effort in days, or a dash if none is approved yet.
   - `Customer`, and `For End Customer` when the ticket is for one.
   - `Start Date`, `Due Date`, `Created` and `Created By`.
5. When deliverables exist, `Open Deliverable Folder` appears under `Deliverable`. It opens the folder of this ticket only, and stays available after the ticket is closed.

## What happens next

When the status changes or the team replies, you get a notification. See [[notifications]].

## Common questions

**Man Days shows a dash.** No effort has been approved for the ticket yet.

**I cannot change the status.** Customers see the status as read only. You can close your ticket yourself with `Close Ticket` in the properties panel. Other statuses are set by the support team.

**I do not see `Open Deliverable Folder`.** No deliverable has been uploaded yet.

<!-- sources: resources/views/tickets/show.blade.php -->
