This is the doc for the data regarding recorded human history.
Add to the files as you wish, sorted by century (further subdivision may be necessary).

#Date
(year day hour minute second)
- year - gregorian calendar
- day - Janruary 1 = 1, February 19 = 50, etc.
- hour - 0-23 ("military" time)
- minute - 0-59
- second - 0-59 (for the moment, leap seconds are not handled and probably never will be)

hour, minute, second in Greenwich Mean Time

#Place
Store as (latitude longitude)
Graph positioning is simply longitude
(but MDS as a possible future replacement)

#Todo
- [ ] settings.lisp
- [ ] event_list.html (access file with php and list with alphabetical indexing)
- [x] Date system
- [x] Place system
- [x] Current data properly formatted
