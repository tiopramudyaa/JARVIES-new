---
key: ticket-chat
chapter: tickets
order: 70
title: Reply and share files
summary: Reply to the support team, copy colleagues by email, attach files and join meetings.
requires: []
updated: 2026-10-29
---
The reply box at the bottom of a ticket is how you talk to the support team. Everything you write is saved in the ticket.

## Who uses this

Customers and Super Admin.

## Before you start

- A reply can have text, files, or both. A message can have up to 5,000 characters.
- Below the box, a line says where your reply goes:
  - `Replies will be sent to the support team via Email`: your reply also travels by email.
  - `Email thread active, helpdesk replies will be sent to your email`: the team's replies also reach your inbox.
  - `Replies only visible in Jarvies, no email will be sent`: the ticket has no email channel.

## Step by step

1. Open the ticket and click in the reply box. Use the toolbar to format the text.
2. For tickets with an email channel, a `CC` row appears. Type an email address and press Enter to add it. Paste several at once if you need to.
3. To attach files, select the attachment button in the toolbar. You can attach up to 5 files of 10 MB each, such as images, PDF, Word, Excel, text, CSV, ZIP and RAR.
4. Select `Send Reply`.
5. Use the small arrow beside the channel line to fold the reply box and read more of the conversation.

### Meetings

When the support team starts a meeting on your ticket, the conversation shows a card named `Meeting Started` with a `Join Meeting` link. When it ends, a `Meeting Ended` card shows the time and the duration. Meetings are started by the support team, not by customers.

## What happens next

Your reply appears in the conversation at once. If the ticket has an email channel, the team also gets it by email. When the team answers, you get a notification and the ticket list marks the row.

## Common questions

**An attachment was refused.** It is over 10 MB, the type is not allowed, or you added more than 5 files. Send them in several replies.

**The CC row is missing.** The ticket has no email channel, so replies stay inside the portal.
<!-- sources: resources/views/tickets/show.blade.php, app/Http/Controllers/TicketController.php -->
