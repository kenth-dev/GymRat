<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Booking Confirmation</title>
    <style>
        /* Design tokens from app.css */
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            color: #e5e7eb;
        }

        .wrapper {
            max-width: 600px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem;
        }

        /* .logo */
        .logo {
            font-weight: 700;
            font-size: 2rem;
            letter-spacing: 0.15em;
            background: linear-gradient(to right, #f97316, #dc2626);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
            margin-bottom: 0.5rem;
        }

        /* .tagline */
        .tagline {
            color: #9ca3af;
            text-align: center;
            font-size: 0.875rem;
            margin-bottom: 2rem;
        }

        /* .dashboard-panel */
        .panel {
            background: rgba(18, 18, 18, 0.85);
            border: 1px solid #2a2a2a;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            border-radius: 0.5rem;
            overflow: hidden;
        }

        /* .gymrat-dashboard-heading */
        .panel-heading {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #2a2a2a;
        }

        .panel-heading h1 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
            background: linear-gradient(to right, #f97316, #dc2626);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: 0.03em;
        }

        /* .upcoming-panel */
        .panel-body {
            padding: 1.7rem 2rem;
        }

        .greeting {
            color: #e5e7eb;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        /* .upcoming-row */
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 2px solid rgba(249, 115, 22, 0.35);
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        /* .upcoming-class-name */
        .detail-label {
            font-size: 1rem;
            font-weight: 700;
            background: linear-gradient(to right, #f97316, #dc2626);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* .upcoming-class-duration */
        .detail-value {
            font-size: 1rem;
            color: #9ca3af;
            text-align: right;
        }

        /* .upcoming-time */
        .detail-value strong {
            font-size: 1.1rem;
            font-weight: 700;
            color: #f3f4f6;
            -webkit-text-fill-color: #f3f4f6;
        }

        /* .footer */
        .footer {
            padding-top: 1.5rem;
            margin-top: 1.5rem;
            border-top: 1px solid #2a2a2a;
            color: #6b7280;
            font-size: 0.875rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="logo">GYMRAT</div>
        <p class="tagline">Train hard. Stay consistent.</p>

        <div class="panel">
            <div class="panel-heading">
                <h1>Booking Confirmed</h1>
            </div>

            <div class="panel-body">
                <p class="greeting">Hi <strong>{{ $user->name }}</strong>, your class has been booked successfully.</p>

                <div class="detail-row">
                    <span class="detail-label">Class</span>
                    <span class="detail-value">{{ $scheduledClass->classType->name }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Description</span>
                    <span class="detail-value">{{ $scheduledClass->classType->description }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Date</span>
                    <span class="detail-value">{{ $scheduledClass->date_time->format('l, F j, Y') }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Time</span>
                    <span class="detail-value"><strong>{{ $scheduledClass->date_time->format('g:i a') }}</strong></span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Duration</span>
                    <span class="detail-value">{{ $scheduledClass->classType->minutes }} minutes</span>
                </div>

                @if($scheduledClass->instructor)
                <div class="detail-row">
                    <span class="detail-label">Instructor</span>
                    <span class="detail-value">{{ $scheduledClass->instructor->name }}</span>
                </div>
                @endif
            </div>
        </div>

        <div class="footer">
            <p>Please arrive 10 minutes early. Cancel at least 2 hours before the class if needed.</p>
            <p style="margin-top: 0.5rem; font-size: 0.75rem;">This is an automated email from GymRat. Please do not reply.</p>
        </div>
    </div>
</body>
</html>
