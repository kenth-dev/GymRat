<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4F46E5;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9fafb;
            padding: 30px;
            border: 1px solid #e5e7eb;
        }
        .class-details {
            background-color: white;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #4F46E5;
            border-radius: 4px;
        }
        .detail-row {
            margin: 10px 0;
        }
        .label {
            font-weight: bold;
            color: #4F46E5;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎉 Booking Confirmed!</h1>
    </div>
    
    <div class="content">
        <p>Hi <strong>{{ $user->name }}</strong>,</p>
        
        <p>Great news! You've successfully booked your class at GymRat.</p>
        
        <div class="class-details">
            <h2 style="margin-top: 0; color: #4F46E5;">Class Details</h2>
            
            <div class="detail-row">
                <span class="label">Class:</span> 
                {{ $scheduledClass->classType->name }}
            </div>
            
            <div class="detail-row">
                <span class="label">Description:</span> 
                {{ $scheduledClass->classType->description }}
            </div>
            
            <div class="detail-row">
                <span class="label">Date:</span> 
                {{ $scheduledClass->date_time->format('l, F j, Y') }}
            </div>
            
            <div class="detail-row">
                <span class="label">Time:</span> 
                {{ $scheduledClass->date_time->format('g:i A') }}
            </div>
            
            <div class="detail-row">
                <span class="label">Duration:</span> 
                {{ $scheduledClass->classType->minutes }} minutes
            </div>
            
            @if($scheduledClass->instructor)
            <div class="detail-row">
                <span class="label">Instructor:</span> 
                {{ $scheduledClass->instructor->name }}
            </div>
            @endif
        </div>
        
        <p><strong>What to bring:</strong></p>
        <ul>
            <li>Water bottle</li>
            <li>Towel</li>
            <li>Comfortable workout clothes</li>
        </ul>
        
        <p><strong>Important:</strong> Please arrive 10 minutes early to check in.</p>
        
        <p>If you need to cancel your booking, please do so at least 2 hours before the class starts.</p>
    </div>
    
    <div class="footer">
        <p>See you at the gym! 💪</p>
        <p style="font-size: 12px;">This is an automated email from GymRat. Please do not reply to this email.</p>
    </div>
</body>
</html>
