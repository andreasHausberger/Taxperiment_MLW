<?php
$dataTables = [
    "audit" =>
    [
      "table" => "audit",
      "display_name" => "Audit",
      "read_only" => true,
      "select_columns" => [],
        "display_columns" => ["ID", "Experiment ID", "Participant ID", "Round", "Actual Income", "Net Income", "Actual Tax", "Declared Tax", "Honesty", "Audit", "Fine", "Selection"]
    ],
    "exp_round" =>
    [
        "table" =>  "exp_round",
        "display_name" => "Experiment Rounds",
        "read_only" => false,
        "select_columns" => [],
        "display_columns" => ["ID", "Tax Rate", "Income", "Audit Probability", "Fine Rate", "Honest Gain", "EV Evasion", "Angle"]
    ],
    "participant" =>
    [
        "table" =>  "participant",
        "display_name" => "Participants",
        "read_only" => true,
        "select_columns" => [],
        "display_columns" => ["ID", "Name", "Prolific PID", "Study ID", "Session ID"]
    ]
];

$showNav = true;