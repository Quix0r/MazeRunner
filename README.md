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

##To Do

 - Command line options allowing the player to override the configuration file keys
 - Options to vary the maze by
   - reversing the start/end points
   - Flip the maze horizontally or vertically
   - Rotate the maze
 - More mazes
 - Special effects when you step into a wall