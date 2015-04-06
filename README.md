#MazeRunner

MazeRunner is a simple maze game for an ANSI console

---

##Instructions

Execute from the command line with
```
php MazeRunner.php
```
from the `/run` folder

Use the following keys to guide your runner (shown as `+`) through the maze to the exit (shown as `@`)

 - `w` (Up)
 - `a` (Left)
 - `s` (Right)
 - `z` (Down)

Unfortunately, PHP doesn't support non-blocking reads from stdin, so you need to press Enter/Return to execute the moves. You can press enter after every move, or setup a string of moves before pressing enter.

Once your runner reaches the marked endpoint, the game ends.

---

##Configuration

By default the config file (in `/run/config`) defines the keys used for `up`, `down`, `left`, `right` and `quit`; the colours for the `maze`, `runner` and `exit`; and the display characters for the `runner` and `exit`. You can change these by editing the config file

Keys and display characters should be a single ASCII character

Valid colour names are:

 - black
 - red
 - green
 - yellow
 - blue
 - magenta
 - cyan
 - white

---

##Command-line Options

You can override some of the configuration settings from the command-line by passing additional arguments

###Overriding Control Keys

Any of the `--up`, `--down`, `--left`, `--right` and `--quit` arguments can be used to override the appropriate keys

```
php MazeRunner.php --up=2 --down=8 --left=4 --right=6 --quit=x
```

###Modifying the Maze

The maze itself can be altered with some additional command-line options

```
php MazeRunner.php --reverse --flip=horizontal,vertical
```

 - `--reverse` will swap the start and end points for the maze
 - `--flip` will flip the maze along horizontally and/or vertically. Valid options are
   - `horizontal`
   - `vertical`

   You can flip both horizontally and vertically at the same time by passing both values separated with a comma (as shown above)
 - `--transpose` will transpose the maze, effectively flip it along the diagonal

---

##To Do


 - Move counter
 - More mazes
 - Special effects when you step into a wall