<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <style>
        body { font-family: 'Courier New', monospace; background: #0a0a0f; color: #e0e0e0; margin: 0; padding: 0; }
        .wrapper { max-width: 580px; margin: 0 auto; padding: 2rem; }
        .header { border-bottom: 1px solid #00d4ff; padding-bottom: 1rem; margin-bottom: 1.5rem; }
        .header h1 { color: #00d4ff; font-size: 1.2rem; margin: 0; letter-spacing: .1em; }
        .field { margin-bottom: 1.2rem; }
        .label { font-size: .7rem; color: #666; letter-spacing: .15em; text-transform: uppercase; margin-bottom: .3rem; }
        .value { font-size: .95rem; color: #e0e0e0; padding: .6rem .8rem; background: #111; border-left: 2px solid #00d4ff; }
        .message-body { white-space: pre-wrap; line-height: 1.6; }
        .footer { margin-top: 2rem; border-top: 1px solid #1a1a2e; padding-top: 1rem; font-size: .7rem; color: #444; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>// NEW PORTFOLIO MESSAGE</h1>
        </div>

        <div class="field">
            <div class="label">From</div>
            <div class="value">{{ $data['name'] }}</div>
        </div>

        <div class="field">
            <div class="label">Email</div>
            <div class="value">{{ $data['email'] }}</div>
        </div>

        <div class="field">
            <div class="label">Subject</div>
            <div class="value">{{ $data['subject'] }}</div>
        </div>

        <div class="field">
            <div class="label">Message</div>
            <div class="value message-body">{{ $data['message'] }}</div>
        </div>

        <div class="footer">
            Sent via wajeeh.dev portfolio contact form · Reply directly to {{ $data['email'] }}
        </div>
    </div>
</body>
</html>
