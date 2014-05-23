history-flowchart
=================
This program is intended to create flowcharts of history in the hope that this may help in searching for patterns that may help in predicting the future. If this plan fails, we'll still get some cool graphs.

It also has the capability to make graphs for other (fictional) universes.

Remember to read all doc.txt files before proceeding (in case this wasn't obvious).

File Structure
- Code
 - graph.lisp == graph maker
 - get-data.lisp == file system interface
 - Interface == human interface
   - [website stuff]
- Data
 - doc.txt == data storage overview
 - human == human history
   - doc.txt == overview
   - settings.lisp == date arithmetic, location, etc.
   - AD_16.txt == events occuring in the 16th century AD
   ...
 - natural == pre-recorded history
   - doc.txt == overview
   - settings.lisp == date arithmetic, location, etc.
   ...
 - ...

TODO list

- [ ] complete levels list
- [ ] name the levels
- [ ] add essay database implementation details
- [ ] finish code (remove placeholders)
- [ ] answer following questions:
  - [ ] how does the graph maker connect to the essay database?
  - [ ]should events specify universe, or be stored separately?
- [ ] make note of
  - [ ] level list length largely lenient (can be changed)
