<?php

namespace App\Enum;

enum CharacterClass: string
{
    case Dwarf = "DWARF";
    case Elf = "ELF";
    case Halfling = "HALFLING";
    case Human = "HUMAN";
    case Dragonborn = "DRAGONBORN";
    case Gnome = "GNOME";
    case HalfElf = "HALF-ELF";
    case HalfOrc = "HALF-ORC";
    case Tiefling = "TIEFLING";
}