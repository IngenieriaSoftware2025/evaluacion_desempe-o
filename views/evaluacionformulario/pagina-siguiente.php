<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluación del Desempeño</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        
        .header-container {
            max-width: 800px;
            margin: 0 auto;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%);
            border-radius: 12px;
            padding: 40px 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .header-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: pulse 4s ease-in-out infinite;
        }
        
        .icon {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            position: relative;
            z-index: 1;
        }
        
        .icon svg {
            width: 40px;
            height: 40px;
            stroke: white;
            stroke-width: 2;
            fill: none;
        }
        
        .title {
            color: white;
            font-size: 28px;
            font-weight: 600;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 1;
            line-height: 1.3;
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 0.5;
                transform: scale(1);
            }
            50% {
                opacity: 0.8;
                transform: scale(1.05);
            }
        }
        
        @media (max-width: 768px) {
            .header-container {
                padding: 30px 20px;
                margin: 0 10px;
            }
            
            .title {
                font-size: 24px;
            }
            
            .icon {
                width: 60px;
                height: 60px;
                margin-bottom: 20px;
            }
            
            .icon svg {
                width: 30px;
                height: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="header-container">
        <div class="icon">
            <svg viewBox="0 0 24 24">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                <polyline points="9,9 9,15"/>
                <polyline points="15,9 15,15"/>
                <line x1="9" y1="12" x2="15" y2="12"/>
            </svg>
        </div>
        <h1 class="title">EVALUACIÓN DEL DESEMPEÑO PARA ESPECIALISTAS</h1>
    </div>
</body>
</html>