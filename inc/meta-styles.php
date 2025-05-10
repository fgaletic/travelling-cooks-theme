<?php

function tc_output_meta_styles()
{
    ?>
    <style>
        .tc-meta-box {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
        }
        .tc-meta-field {
            margin-bottom: 20px;
        }
        .tc-meta-field label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #1e1e1e;
        }
        .tc-meta-field input[type="text"],
        .tc-meta-field select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .tc-meta-field select {
            height: 38px;
        }
        .tc-meta-field input[type="text"]:focus,
        .tc-meta-field select:focus {
            border-color: #2271b1;
            box-shadow: 0 0 0 1px #2271b1;
            outline: none;
        }
        .tc-meta-description {
            color: #666;
            font-style: italic;
            font-size: 13px;
            margin-top: 4px;
        }
        .tc-meta-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .tc-meta-full {
            grid-column: 1 / -1;
        }
        .tc-meta-textarea {
            width: 100%;
            min-height: 150px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
    <?php
}
