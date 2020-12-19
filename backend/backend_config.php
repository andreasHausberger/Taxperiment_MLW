<?php
$dataTables = [
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