<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle réservation</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .booking-details {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }
        .highlight {
            color: #667eea;
            font-weight: bold;
        }
        .button {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎉 Nouvelle réservation reçue !</h1>
        <p>Bonjour {{ $hostName }}, vous avez reçu une nouvelle réservation !</p>
    </div>
    
    <div class="content">
        <div class="booking-details">
            <h2>Détails de la réservation</h2>
            <p><strong>Propriété :</strong> <span class="highlight">{{ $booking->listing->titre }}</span></p>
            <p><strong>Client :</strong> {{ $clientName }}</p>
            <p><strong>Date d'arrivée :</strong> {{ \Carbon\Carbon::parse($booking->date_debut)->format('d/m/Y') }}</p>
            <p><strong>Date de départ :</strong> {{ \Carbon\Carbon::parse($booking->date_fin)->format('d/m/Y') }}</p>
            <p><strong>Nombre de nuits :</strong> {{ \Carbon\Carbon::parse($booking->date_debut)->diffInDays($booking->date_fin) }}</p>
            <p><strong>Montant total :</strong> <span class="highlight">{{ number_format($booking->montant_total, 2) }} €</span></p>
            <p><strong>Statut :</strong> 
                @if($booking->statut === 'en_attente')
                    <span style="color: #f39c12;">En attente de confirmation</span>
                @elseif($booking->statut === 'confirmee')
                    <span style="color: #27ae60;">Confirmée</span>
                @else
                    <span style="color: #e74c3c;">Annulée</span>
                @endif
            </p>
        </div>
        
        <p>Un client souhaite réserver votre propriété. Veuillez vous connecter à votre tableau de bord pour confirmer ou refuser cette réservation.</p>
        
        <div style="text-align: center;">
            <a href="{{ route('host.bookings.index') }}" class="button">Voir mes réservations</a>
        </div>
        
        <div class="footer">
            <p>Merci d'utiliser PlaceZo pour la gestion de vos propriétés !</p>
            <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre directement.</p>
        </div>
    </div>
</body>
</html>
