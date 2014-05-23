history-flowchart
=================
This program is intended to create flowcharts of history in the hope that this may help in searching for patterns that may help in predicting the future. If this plan fails, we'll still get some cool graphs.

It also has the capability to make graphs for other (fictional) universes.

Remember to read all doc.txt files before proceeding (in case this wasn't obvious).

##File Structure
- Code
  - doc.md
  - graph.lisp == graph maker
  - get-data.lisp == file system interface
  - Interface == human interface
     - [website stuff]
- Data
  - doc.md == data storage overview
  - human == human history
    - doc.md == overview
    - settings.lisp == date arithmetic, location, etc.
    - AD_16.txt == events occuring in the 16th century AD
    - ...
  - natural == pre-recorded history
    - doc.md == overview
    - settings.lisp == date arithmetic, location, etc.
    - ...
  - ...

##TODO list

see doc.md's for todo lists
