---
key: settings
chapter: account
order: 110
title: Settings
summary: Change the theme, accent colour, text size, notifications and see how to change your password.
requires: []
updated: 2026-10-29
---
`Settings` changes how the portal looks and behaves for you. It does not change anything for other people.

## Who uses this

Everyone who signs in.

## Before you start

Your choices are saved to your account, so they follow you to another browser or device after you sign in. If the portal cannot reach the server, it saves them in this browser only and says so.

## Step by step

![The Settings page on the Appearance tab with theme mode and accent colour](images/guide/jarvies-settings.png)

*Screenshot with sample data.*

1. Open `Settings` from the menu. The page has four tabs.
2. `Appearance`: choose `Theme Mode` (`Light`, `Dark` or `System`, which follows your device) and an `Accent Color`, which is used for buttons, links and highlights. Pick one of the six ready colours, or choose your own with `Custom color`.
3. `Preferences`: choose `Font Size` (`Small`, `Medium` or `Large`), switch `Compact Mode` for a denser layout, and switch `Show Animations` on or off.
4. `Notifications`: switch `Enable Notifications` on or off, choose a `Notification Sound`, or select `Clear All` to clear the history. See [[notifications]].
5. `Security`: shows `Password Reset`. To change your password, use `Send Password Reset Link` on your profile. The same tab shows your `Account`, `Role` and `Customer Code` under `Current Session`.
6. Select `Save Changes` to keep your choices. `Reset to Default` returns everything to the original values after you confirm.

## What happens next

The page applies your choices at once and shows `Settings saved successfully!` after you save. Settings are personal and do not change your tickets.

## Common questions

**It says `Settings saved locally only.`** The server could not be reached. Your choices work in this browser. Save again when the connection is back.

**Where do I change my password?** See [[sign-in]].

<!-- sources: resources/views/settings/index.blade.php, app/Http/Controllers/SettingsController.php -->
