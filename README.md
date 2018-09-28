# DnD

[![Build Status](https://travis-ci.com/sensorario/dnd.svg?branch=master)](https://travis-ci.com/sensorario/dnd)

## Usage

This command simulate the battle between two opponents. It shows just the
winner.

```bash
php scripts/FightToTheDeath.php
```

To see the complete fight it could be better to read the log (/logs/debug.log).

```
[2018-09-28 05:43:36] log.DEBUG Rupert infligge un danno di 12 a Norbert che aveva 42
[2018-09-28 05:43:36] log.DEBUG Norbert infligge un danno di 12 a Rupert che aveva 42
[2018-09-28 05:43:36] log.DEBUG Rupert infligge un danno di 11 a Norbert che aveva 30
[2018-09-28 05:43:36] log.DEBUG Norbert infligge un danno di 8 a Rupert che aveva 30
[2018-09-28 05:43:36] log.DEBUG Rupert infligge un danno di 13 a Norbert che aveva 19
[2018-09-28 05:43:36] log.DEBUG Norbert segna un colpo a vuoto 
[2018-09-28 05:43:36] log.DEBUG Rupert infligge un danno di 8 a Norbert che aveva 6
```
