#TODO
- [ ] add input method
  - [ ] specific fields for information about events
    - [ ] determine identity of said fields
- [ ] add method for adding multiple versions
  - store each event/effect as a folder?
    - probably just effects, events not as much.
- [ ] add method for objecting
- [ ] add voting system

#File Format

###Event Essay

name: path/to/essays/[universe]/[event]/number-of-essays-including-this-one.txt

format:

votes = # (+, -)

[headers]
date = nn/nn/nn ...

[essay]
...Then general blah said...

[citations]
[3] johnson, bob ...

###Effect Essay

name: path/to/essays/[universe]/[from]_[to]/number-of-essays-including-this-one.txt

format:

votes = # (+, -)

[tags]

[essay]

[citations]

###Comment

name: response/to/thingy/path_#ofresponses.txt

format:

vote = + [or -]

Poster

comment
