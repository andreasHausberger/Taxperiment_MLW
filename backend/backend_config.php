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
    "mlweb" =>
        [
            "table" => "mlweb",
            "display_name" => "Mouselab Data",
            "read_only" => true,
            "select_columns" => ["id", "expname", "subject", "submitted", "round", "procdata"],
            "display_columns" => ["ID", "Experiment Name", "Subject ID", "Submitted", "Round", "Process Data"]
        ],
    "exp_round" =>
        [
            "table" => "exp_round",
            "display_name" => "Experiment Rounds",
            "read_only" => true,
            "select_columns" => [],
            "display_columns" => ["ID", "Tax Rate", "Income", "Audit Probability", "Fine Rate", "Honest Gain", "EV Evasion", "Angle"]
        ],
    "participant" =>
        [
            "table" => "participant",
            "display_name" => "Participants",
            "read_only" => true,
            "select_columns" => [],
            "display_columns" => ["ID", "Name", "Prolific PID", "Study ID", "Session ID"]
        ]
];

$showNav = true;