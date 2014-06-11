# Web based system stats

A friend wanted a stats page that showed terminal output that refreshed every few seconds.

This is the cheesiest, most dangerous possible thing I could come up with in 20 minutes. Do yourself a favor and put it behind authentication.

Also, the PATH on my system was screwed up so run.php will fix the PATH before it tries to execute anything. It will set it to /{usr/local/,usr/,}{s,}bin.
