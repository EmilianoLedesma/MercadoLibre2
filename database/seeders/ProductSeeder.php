<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegúrate de que existan usuarios y categorías
        $userCount = User::count();
        if ($userCount === 0) {
            User::factory(5)->create();
        }
        
        $categoryCount = Category::count();
        if ($categoryCount === 0) {
            $this->call(CategorySeeder::class);
        }

                // Obtener categorías y usuarios para asignar
        $tecnologia = Category::where('name', 'Tecnología')->first();
        $electrodomesticos = Category::where('name', 'Electrodomésticos')->first();
        $hogar = Category::where('name', 'Hogar y Muebles')->first();
        $moda = Category::where('name', 'Moda')->first();
        $deportes = Category::where('name', 'Deportes y Fitness')->first();
        $juguetes = Category::where('name', 'Juguetes y Bebés')->first();
        $belleza = Category::where('name', 'Belleza y Cuidado Personal')->first();
        $herramientas = Category::where('name', 'Herramientas')->first();
        $libros = Category::where('name', 'Libros y Entretenimiento')->first();
        $automotriz = Category::where('name', 'Automotriz')->first();
        $jardin = Category::where('name', 'Jardín y Exterior')->first();
        $alimentos = Category::where('name', 'Alimentos y Bebidas')->first();
        
        // Obtener SOLO usuarios con rol 'seller'
        $sellers = User::where('role', 'seller')->get();
        
        // Si no hay vendedores, crear al menos uno
        if ($sellers->count() === 0) {
            $seller = User::create([
                'name' => 'Vendedor Demo',
                'email' => 'vendor@demo.com',
                'password' => bcrypt('password123'),
                'role' => 'seller',
                'is_active' => true,
            ]);
            $sellers = collect([$seller]);
        }
        
        // Productos de Tecnología (10 productos) - Precios en MXN - URLs ORIGINALES que funcionaban
        $techProducts = [
            ['name' => 'Samsung Galaxy A54 5G 128GB', 'price' => 7899.00, 'stock_quantity' => 45, 'description' => 'Smartphone Samsung Galaxy A54 con pantalla AMOLED de 6.4", cámara triple de 50MP, batería de 5000mAh y carga rápida de 25W', 'images' => ['https://m.media-amazon.com/images/I/61F5Z1vyH6L._AC_SX679_.jpg']],
            ['name' => 'iPhone 13 128GB', 'price' => 15999.00, 'stock_quantity' => 20, 'description' => 'Apple iPhone 13 con chip A15 Bionic, sistema de cámara dual de 12MP, pantalla Super Retina XDR de 6.1" y resistencia al agua IP68', 'images' => ['https://m.media-amazon.com/images/I/61wVdpwmktL._AC_SX466_.jpg']],
            ['name' => 'Laptop Lenovo IdeaPad 3 15.6"', 'price' => 9899.00, 'stock_quantity' => 30, 'description' => 'Laptop con procesador Intel Core i5 de 11va generación, 8GB RAM DDR4, SSD 256GB NVMe, Windows 11 Home y pantalla FHD', 'images' => ['https://m.media-amazon.com/images/I/71C3eQton9L._AC_SX466_.jpg']],
            ['name' => 'Audífonos Sony WH-1000XM4', 'price' => 5499.00, 'stock_quantity' => 60, 'description' => 'Audífonos inalámbricos con cancelación de ruido activa líder en la industria, hasta 30 horas de batería, Bluetooth multipoint y audio Hi-Res', 'images' => ['https://m.media-amazon.com/images/I/41VEMU8feUL._AC_SX466_.jpg']],
            ['name' => 'Tablet Samsung Galaxy Tab A8', 'price' => 3899.00, 'stock_quantity' => 35, 'description' => 'Tablet de 10.5" con procesador octa-core, 4GB RAM, 64GB almacenamiento expandible, batería de 7040mAh y sonido Dolby Atmos', 'images' => ['https://m.media-amazon.com/images/I/41f0apAL67L._AC_SX679_.jpg']],
            ['name' => 'Smart TV LG 50" 4K UHD', 'price' => 8999.00, 'stock_quantity' => 25, 'description' => 'Smart TV LED 50 pulgadas con resolución 4K Real, sistema operativo WebOS 22, HDR10, procesador α5 Gen5 AI y Magic Remote incluido', 'images' => ['https://m.media-amazon.com/images/I/711K+vjXWFL._AC_SX679_.jpg']],
            ['name' => 'MacBook Air M2 256GB', 'price' => 24999.00, 'stock_quantity' => 12, 'description' => 'MacBook Air con chip M2 de Apple, pantalla Liquid Retina de 13.6", 8GB memoria unificada, SSD de 256GB, hasta 18 horas de batería', 'images' => ['https://m.media-amazon.com/images/I/71zbUS9KpQL._AC_SX466_.jpg']],
            ['name' => 'Mouse Logitech MX Master 3', 'price' => 1899.00, 'stock_quantity' => 80, 'description' => 'Mouse inalámbrico ergonómico con sensor de alta precisión de 4000 DPI, 7 botones personalizables, rueda electromagnética y hasta 70 días de batería', 'images' => ['https://m.media-amazon.com/images/I/61iiZ-gDYEL._AC_SX466_.jpg']],
            ['name' => 'Teclado Mecánico Razer BlackWidow V3', 'price' => 2599.00, 'stock_quantity' => 40, 'description' => 'Teclado mecánico gaming con switches mecánicos Razer Green, iluminación RGB Chroma personalizable, reposamuñecas ergonómico y teclas programables', 'images' => ['https://m.media-amazon.com/images/I/81y14ID9oHL._AC_SX466_.jpg']],
            ['name' => 'Webcam Logitech C920 HD Pro', 'price' => 1499.00, 'stock_quantity' => 55, 'description' => 'Cámara web Full HD 1080p a 30fps, enfoque automático HD, corrección de iluminación automática, micrófono estéreo integrado, compatible con Windows y Mac', 'images' => ['https://m.media-amazon.com/images/I/71eGb1FcyiL._AC_SX466_.jpg']],
        ];

        // Productos de Electrodomésticos (10 productos) - Precios en MXN
        $electroProducts = [
            ['name' => 'Refrigerador Whirlpool No Frost 340L', 'price' => 12999.00, 'stock_quantity' => 15, 'description' => 'Refrigerador con freezer, tecnología No Frost, eficiencia energética A+, control de temperatura digital y dispensador de agua', 'images' => ['https://m.media-amazon.com/images/I/71oQcVQb6zL._AC_SX679_.jpg']],
            ['name' => 'Lavadora Samsung 17kg Carga Frontal', 'price' => 8999.00, 'stock_quantity' => 20, 'description' => 'Lavadora automática carga frontal con 12 programas de lavado, display digital LED, tecnología Eco Bubble y tambor Diamond Drum', 'images' => ['https://m.media-amazon.com/images/I/61XWBNHiKxL._AC_SX679_.jpg']],
            ['name' => 'Microondas Mabe 23L', 'price' => 1899.00, 'stock_quantity' => 40, 'description' => 'Microondas con grill, 800W de potencia, 8 niveles de potencia, plato giratorio de cristal y función de descongelación automática', 'images' => ['https://m.media-amazon.com/images/I/51PIHVzbpSL._AC_SX679_.jpg']],
            ['name' => 'Aire Acondicionado Split 3000W', 'price' => 7899.00, 'stock_quantity' => 18, 'description' => 'Aire acondicionado frío/calor con gas ecológico R410A, control remoto, modo Sleep, temporizador 24hrs y filtro lavable', 'images' => ['https://m.media-amazon.com/images/I/51jmIThVXHL._AC_SX679_.jpg']],
            ['name' => 'Licuadora Oster Reversible', 'price' => 1299.00, 'stock_quantity' => 65, 'description' => 'Licuadora de 600W con sistema de aspas reversibles, jarra de vidrio de 1.5L, 5 velocidades y función para picar hielo', 'images' => ['https://m.media-amazon.com/images/I/61wNw92VxDL._AC_SX679_.jpg']],
            ['name' => 'Cafetera Express Oster Prima Latte', 'price' => 2999.00, 'stock_quantity' => 30, 'description' => 'Cafetera espresso con bomba italiana de 15 bares, vaporizador para capuccinos, bandeja antigoteo y portafiltros con doble salida', 'images' => ['https://m.media-amazon.com/images/I/51JGuzdYnTL._AC_SX679_.jpg']],
            ['name' => 'Aspiradora Robot iRobot Roomba', 'price' => 7999.00, 'stock_quantity' => 22, 'description' => 'Aspiradora robot inteligente con sistema de navegación iAdapt, mapeo Smart Mapping, app móvil iRobot Home y base de recarga automática', 'images' => ['https://m.media-amazon.com/images/I/7167vU8MODL._AC_SX679_.jpg']],
            ['name' => 'Horno Eléctrico Hamilton Beach 42L', 'price' => 2399.00, 'stock_quantity' => 28, 'description' => 'Horno eléctrico con parrilla rotisería, luz interior, bandeja para hornear, función de convección y temporizador de 60 minutos', 'images' => ['https://m.media-amazon.com/images/I/61+SKPgOCoL._AC_SX679_.jpg']],
            ['name' => 'Plancha de Vapor Black+Decker', 'price' => 699.00, 'stock_quantity' => 90, 'description' => 'Plancha a vapor de 1200W con suela antiadherente SmartSteam, sistema antigoteo, rocío nebulizador y cable giratorio 360°', 'images' => ['https://m.media-amazon.com/images/I/71v1zFxlTwL._AC_SX679_.jpg']],
            ['name' => 'Ventilador de Pedestal Lasko 20"', 'price' => 899.00, 'stock_quantity' => 75, 'description' => 'Ventilador de pedestal de 20" con 3 velocidades, altura regulable de 1.10m a 1.35m, oscilación automática y motor silencioso', 'images' => ['https://m.media-amazon.com/images/I/813gL4oihXL._AC_SX679_.jpg']],
        ];

        // Productos de Hogar y Muebles (10 productos) - Precios en MXN
        $hogarProducts = [
            ['name' => 'Juego de Sábanas 2 Plazas Matrimonial', 'price' => 499.00, 'stock_quantity' => 80, 'description' => 'Juego de sábanas 100% algodón egipcio de 300 hilos, incluye 1 sábana ajustable, 1 sábana plana y 2 fundas para almohada, varios colores disponibles', 'images' => ['https://m.media-amazon.com/images/I/81-kmZt4R-L._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Comedor de Madera para 6 Personas', 'price' => 3199.00, 'stock_quantity' => 12, 'description' => 'Mesa rectangular de madera de pino con acabado natural laqueado, incluye 6 sillas tapizadas con respaldo ergonómico, dimensiones 180x90cm', 'images' => ['https://m.media-amazon.com/images/I/51-ajAR9qvL._AC_SX679_.jpg']],
            ['name' => 'Sillón Reclinable Relax', 'price' => 4599.00, 'stock_quantity' => 10, 'description' => 'Sillón reclinable individual tapizado en piel sintética premium, reposapiés extensible, palanca lateral de ajuste, estructura de acero reforzado', 'images' => ['https://m.media-amazon.com/images/I/71k1gojS0dL._AC_SX679_.jpg']],
            ['name' => 'Lámpara de Piso LED Moderna', 'price' => 699.00, 'stock_quantity' => 55, 'description' => 'Lámpara de pie minimalista con brazo ajustable, foco LED de 12W incluido, dimmer touch integrado, acabado en negro mate', 'images' => ['https://m.media-amazon.com/images/I/61sg4Ogc27L._AC_SX679_.jpg']],
            ['name' => 'Tapete Shaggy Pelo Alto 160x230cm', 'price' => 1799.00, 'stock_quantity' => 35, 'description' => 'Alfombra suave de pelo alto de 5cm, fibra sintética antialérgica, base antideslizante, fácil limpieza, disponible en gris, beige y blanco', 'images' => ['https://m.media-amazon.com/images/I/8141o6dk9AL._AC_SX679_.jpg']],
            ['name' => 'Espejo Decorativo Dorado 80cm', 'price' => 1099.00, 'stock_quantity' => 42, 'description' => 'Espejo de pared redondo con marco de metal acabado dorado, 80cm de diámetro, cristal de 4mm, soporte de montaje incluido, estilo moderno', 'images' => ['https://m.media-amazon.com/images/I/71GXSvDIkZL._AC_SX679_.jpg']],
            ['name' => 'Juego de Toallas 6 Piezas Premium', 'price' => 379.00, 'stock_quantity' => 95, 'description' => 'Set de toallas 100% algodón turco de 600 gsm: 2 toallas de baño (70x140cm), 2 toallas de manos (50x90cm) y 2 toallas faciales (30x30cm)', 'images' => ['https://m.media-amazon.com/images/I/71ZeeGhvH0L._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Cortinas Blackout Térmicas', 'price' => 599.00, 'stock_quantity' => 60, 'description' => 'Cortinas opacas con aislamiento térmico, bloquean 99% de luz, con ojillos metálicos, 140x220cm, disponibles en varios colores', 'images' => ['https://m.media-amazon.com/images/I/51XjX5MGLyL._AC_SX679_.jpg']],
            ['name' => 'Perchero de Piso Moderno', 'price' => 399.00, 'stock_quantity' => 70, 'description' => 'Perchero minimalista de madera de haya con 8 ganchos de metal, base circular pesada para mayor estabilidad, altura 175cm, fácil armado', 'images' => ['https://m.media-amazon.com/images/I/51ym9YXTrAL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Cojines Decorativos Premium Set 4', 'price' => 299.00, 'stock_quantity' => 88, 'description' => 'Set de 4 cojines decorativos 45x45cm con fundas removibles de algodón, relleno de fibra siliconada, cierre oculto, patrones modernos', 'images' => ['https://m.media-amazon.com/images/I/51kWqvcEm9L._AC_SX679_.jpg']],
        ];

        // Productos de Moda (10 productos) - Precios en MXN
        $modaProducts = [
            ['name' => 'Tenis Nike Air Max 90', 'price' => 2599.00, 'stock_quantity' => 65, 'description' => 'Tenis deportivos con tecnología Air Max visible, diseño retro urbano, suela de goma duradera, upper de malla y cuero sintético, varios colores', 'images' => ['https://m.media-amazon.com/images/I/81Nvcw7SkdL._AC_SX535_.jpg']],
            ['name' => 'Jeans Levi\'s 501 Original Fit', 'price' => 1599.00, 'stock_quantity' => 90, 'description' => 'Jeans clásicos de corte recto, 100% algodón denim índigo, botón de cierre, 5 bolsillos, diseño atemporal desde 1873', 'images' => ['https://m.media-amazon.com/images/I/71XwMWjLJpL._AC_SX569_.jpg']],
            ['name' => 'Chamarra The North Face Impermeable', 'price' => 3799.00, 'stock_quantity' => 30, 'description' => 'Chamarra con capucha ajustable, aislamiento térmico DryVent, costuras selladas, bolsillos con zipper, ideal para clima frío y lluvioso', 'images' => ['https://m.media-amazon.com/images/I/61dXlzqqN5L._AC_SX466_.jpg']],
            ['name' => 'Playera Adidas Originals Trefoil', 'price' => 599.00, 'stock_quantity' => 120, 'description' => 'Playera de algodón 100%, logo Trefoil clásico bordado al frente, corte regular, cuello redondo, disponible en varios colores', 'images' => ['https://m.media-amazon.com/images/I/61FFzxbirzL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Vestido Zara Estampado Floral', 'price' => 999.00, 'stock_quantity' => 45, 'description' => 'Vestido midi con estampado de flores, mangas cortas, cinturón desmontable, forro interior, cierre lateral con cremallera, estilo romántico', 'images' => ['https://m.media-amazon.com/images/I/71MvvOHJhrL._AC_SX679_.jpg']],
            ['name' => 'Sudadera Puma con Capucha', 'price' => 1199.00, 'stock_quantity' => 78, 'description' => 'Sudadera con capucha ajustable, bolsillo canguro, logo Puma cat bordado, mezcla de algodón y poliéster, ajuste cómodo', 'images' => ['https://m.media-amazon.com/images/I/51wt6Q6qaSL._AC_SX569_.jpg']],
            ['name' => 'Botas Dr. Martens 1460 Cuero', 'price' => 3399.00, 'stock_quantity' => 35, 'description' => 'Botas icónicas de cuero genuino Nappa, suela AirWair con tecnología de absorción de impactos, 8 ojales, costura amarilla distintiva', 'images' => ['https://m.media-amazon.com/images/I/714mghDuZ9L._AC_SY675_.jpg']],
            ['name' => 'Gorra New Era 9FIFTY Yankees', 'price' => 499.00, 'stock_quantity' => 100, 'description' => 'Gorra snapback ajustable, logo NY bordado frontal, visera plana, 80% acrílico 20% lana, diseño clásico oficial MLB', 'images' => ['https://m.media-amazon.com/images/I/71IVdGlrL5L._AC_SX679_.jpg']],
            ['name' => 'Reloj Casio G-Shock GA-2100', 'price' => 1799.00, 'stock_quantity' => 52, 'description' => 'Reloj digital-analógico resistente al agua 200m, estructura Carbon Core Guard, cronómetro, alarma, luz LED, batería de 3 años', 'images' => ['https://m.media-amazon.com/images/I/71xVOCDdb0L._AC_SX679_.jpg']],
            ['name' => 'Mochila Eastpak Padded Pak\'r', 'price' => 899.00, 'stock_quantity' => 85, 'description' => 'Mochila urbana de 24L, compartimento acolchado para laptop 13", bolsillo frontal, correas acolchadas, 30 años de garantía, 100% nylon', 'images' => ['https://m.media-amazon.com/images/I/71I6IiDsnHL._AC_SX679_.jpg']],
        ];

        // Productos de Deportes y Fitness (10 productos) - Precios en MXN
        $deportesProducts = [
            ['name' => 'Bicicleta Mountain Bike R29', 'price' => 6999.00, 'stock_quantity' => 15, 'description' => 'Bicicleta todo terreno rodada 29 con cambios Shimano 21 velocidades, suspensión delantera y frenos de disco mecánicos, cuadro de aluminio', 'images' => ['https://m.media-amazon.com/images/I/71xuG21-zTL._AC_SX679_.jpg']],
            ['name' => 'Pelota de Fútbol Nike Strike', 'price' => 399.00, 'stock_quantity' => 75, 'description' => 'Balón de fútbol oficial tamaño 5 con tecnología Aerowtrac para vuelo estable, construcción de 12 paneles moldeados térmicamente', 'images' => ['https://m.media-amazon.com/images/I/71bgARSO2EL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Mancuernas Set 20kg Ajustables', 'price' => 899.00, 'stock_quantity' => 40, 'description' => 'Set de mancuernas ajustables con discos revestidos en goma antideslizante, barra cromada antioxidante y cierre de seguridad tipo tuerca', 'images' => ['https://m.media-amazon.com/images/I/71Siv2KT5jL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Colchoneta Yoga Premium 6mm', 'price' => 299.00, 'stock_quantity' => 85, 'description' => 'Mat de yoga antideslizante de 6mm con superficie texturizada, material NBR ecológico, bolso de transporte con correa ajustable', 'images' => ['https://m.media-amazon.com/images/I/71un8OsQHFL._AC_SX679_.jpg']],
            ['name' => 'Cinta de Correr Profesional', 'price' => 11999.00, 'stock_quantity' => 8, 'description' => 'Cinta motorizada plegable con motor de 2.5HP, pantalla LCD multifunción, 12 programas preestablecidos, velocidad hasta 12 km/h, soporta 120kg', 'images' => ['https://m.media-amazon.com/images/I/719uh1Um6aL._AC_SX300_SY300_QL70_ML2_.jpg']],
            ['name' => 'Pesas Rusas Kettlebell 12kg', 'price' => 699.00, 'stock_quantity' => 55, 'description' => 'Kettlebell de hierro fundido sólido con recubrimiento vinílico de alta calidad, mango texturizado antideslizante, base plana para mayor estabilidad', 'images' => ['https://m.media-amazon.com/images/I/71qrBgUzwHL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Raqueta de Tenis Wilson Pro Staff', 'price' => 1599.00, 'stock_quantity' => 28, 'description' => 'Raqueta de tenis profesional con marco de grafito carbono, patrón de encordado 16x19, grip antideslizante, peso 300g, incluye funda protectora', 'images' => ['https://m.media-amazon.com/images/I/61YARwXt2-L._AC_SX679_.jpg']],
            ['name' => 'Botines Adidas Predator Accuracy', 'price' => 2399.00, 'stock_quantity' => 48, 'description' => 'Botines de fútbol con tecnología Strike Zone para mejor control del balón, tapones de TPU para césped natural, upper Primeknit ajustado', 'images' => ['https://m.media-amazon.com/images/I/51wGx4QFzSL._AC_SY535_.jpg']],
            ['name' => 'Guantes de Boxeo Everlast Pro Style', 'price' => 799.00, 'stock_quantity' => 62, 'description' => 'Guantes de boxeo 12oz con relleno de espuma de alta densidad, cierre de velcro ajustable, material sintético duradero, ventilación en palma', 'images' => ['https://m.media-amazon.com/images/I/51WynWSI6tL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Banco Musculación Multifunción', 'price' => 4599.00, 'stock_quantity' => 18, 'description' => 'Banco ajustable con 7 posiciones de respaldo, soporte para barras con doble gancho de seguridad, extensiones de piernas y curl predicador, soporta 300kg', 'images' => ['https://m.media-amazon.com/images/I/51lNsAX2LsL._AC_SY300_SX300_QL70_ML2_.jpg']],
        ];

        // Productos de Juguetes y Bebés (10 productos) - Precios en MXN
        $juguetesProducts = [
            ['name' => 'LEGO Star Wars Millennium Falcon', 'price' => 1799.00, 'stock_quantity' => 25, 'description' => 'Set de construcción con 1351 piezas para edades 9+, incluye 7 minifiguras de personajes icónicos, detalles auténticos del Halcón Milenario', 'images' => ['https://m.media-amazon.com/images/I/81jbkbN83BL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Carriola Infanti 3 en 1', 'price' => 5599.00, 'stock_quantity' => 12, 'description' => 'Sistema de viaje modular: carriola reversible, moisés para recién nacidos y silla para auto grupo 0+, estructura de aluminio plegable, capota extensible', 'images' => ['https://m.media-amazon.com/images/I/51zgtakttHL._AC_SX466_.jpg']],
            ['name' => 'Casa de Muñecas Barbie Dreamhouse', 'price' => 1099.00, 'stock_quantity' => 35, 'description' => 'Casa de muñecas de 3 pisos y 8 habitaciones con muebles y accesorios, elevador que funciona, alberca con tobogán, luces y sonidos interactivos', 'images' => ['https://m.media-amazon.com/images/I/71a-hDtJdVL._AC_SX679_.jpg']],
            ['name' => 'Hot Wheels Pista Mega Salto', 'price' => 699.00, 'stock_quantity' => 50, 'description' => 'Pista de autos con loop vertical, rampa de salto extremo, lanzador de alta velocidad y zona de aterrizaje, incluye 2 vehículos Hot Wheels', 'images' => ['https://m.media-amazon.com/images/I/812uUsFTBCL._AC_SX300_SY300_QL70_ML2_.jpg']],
            ['name' => 'Pañales Pampers Premium Care', 'price' => 599.00, 'stock_quantity' => 120, 'description' => 'Paquete de 72 pañales desechables talla M (6-10kg) con tecnología absorbente de 12 horas, canales de aire, indicador de humedad, hipoalergénicos', 'images' => ['https://m.media-amazon.com/images/I/61-rwDxGJcL._AC_SX679_.jpg']],
            ['name' => 'Silla de Comer Chicco Polly Magic', 'price' => 2999.00, 'stock_quantity' => 22, 'description' => 'Silla alta reclinable con bandeja doble removible, 7 posiciones de altura, respaldo con 4 posiciones, ruedas giratorias, funda lavable a máquina', 'images' => ['https://m.media-amazon.com/images/I/61muo1wQZhL._AC_SX679_.jpg']],
            ['name' => 'Juego de Mesa Monopoly Clásico', 'price' => 499.00, 'stock_quantity' => 68, 'description' => 'Juego clásico de propiedades para 2-8 jugadores, incluye tablero, fichas metálicas, tarjetas, dinero, casas y hoteles, versión en español', 'images' => ['https://m.media-amazon.com/images/I/81T7hKpWNNL._AC_SX679_.jpg']],
            ['name' => 'Peluche Osito Gigante 120cm', 'price' => 899.00, 'stock_quantity' => 30, 'description' => 'Peluche de oso de felpa suave y abrazable de 120cm de altura, relleno hipoalergénico de fibra siliconada, ideal para decoración y compañía', 'images' => ['https://m.media-amazon.com/images/I/71CuLqgZReL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Biberones Dr. Browns Set 4 Piezas', 'price' => 399.00, 'stock_quantity' => 95, 'description' => 'Set de 4 biberones anticólicos de 240ml con sistema de ventilación interna que reduce gases, tetinas de silicón nivel 1, libre de BPA', 'images' => ['https://m.media-amazon.com/images/I/81vLrLJ-5mL._AC_SX679_.jpg']],
            ['name' => 'Triciclo Fisher-Price Charm Plus', 'price' => 1599.00, 'stock_quantity' => 38, 'description' => 'Triciclo evolutivo 3 en 1 con barra de empuje para padres, respaldo reclinable, capota extensible con protección UV, arnés de seguridad de 3 puntos', 'images' => ['https://m.media-amazon.com/images/I/71svrr+h+pL._AC_SX679_.jpg']],
        ];

        // Productos de Belleza y Cuidado Personal (10 productos) - Precios en MXN
        $bellezaProducts = [
            ['name' => 'Perfume Carolina Herrera Good Girl', 'price' => 2999.00, 'stock_quantity' => 40, 'description' => 'Eau de Parfum 80ml con notas de jazmín sambac, almendra y café tostado, frasco icónico en forma de tacón alto, fragancia oriental floral', 'images' => ['https://m.media-amazon.com/images/I/51NMHzKO6XL._AC_SX679_.jpg']],
            ['name' => 'Set Maquillaje MAC Professional', 'price' => 3999.00, 'stock_quantity' => 22, 'description' => 'Kit profesional completo con paleta de 12 sombras, 3 labiales mate, iluminador, rubor, delineador de ojos y set de 5 brochas sintéticas', 'images' => ['https://m.media-amazon.com/images/I/81hyPn-fn7L._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Secador de Pelo Philips 2200W', 'price' => 799.00, 'stock_quantity' => 50, 'description' => 'Secador profesional con tecnología iónica ThermoProtect, 6 combinaciones de velocidad/temperatura, concentrador de aire de 9mm, cable de 1.8m', 'images' => ['https://m.media-amazon.com/images/I/71x35TC3TbL._AC_SX679_.jpg']],
            ['name' => 'Crema Facial La Roche-Posay Hyalu B5', 'price' => 699.00, 'stock_quantity' => 75, 'description' => 'Crema hidratante anti-edad con ácido hialurónico puro, vitamina B5, protección SPF 30, textura ligera de rápida absorción, 50ml', 'images' => ['https://m.media-amazon.com/images/I/51nVKyHy4zL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Shampoo Pantene Pro-V Restauración', 'price' => 179.00, 'stock_quantity' => 150, 'description' => 'Shampoo reparador 400ml para cabello dañado con Pro-Vitamina B5, antioxidantes y lípidos protectores, restaura el cabello desde la raíz', 'images' => ['https://m.media-amazon.com/images/I/41xkFkHwTTL._AC_SX679_.jpg']],
            ['name' => 'Plancha de Pelo BaByliss PRO Nano Titanium', 'price' => 1799.00, 'stock_quantity' => 35, 'description' => 'Plancha profesional con placas de titanio nano de 1.5", control de temperatura 150-230°C, calentamiento rápido en 30 segundos, cable giratorio', 'images' => ['https://m.media-amazon.com/images/I/71Bza0uzLyL._AC_SX522_.jpg']],
            ['name' => 'Kit Cuidado de Uñas Revlon', 'price' => 499.00, 'stock_quantity' => 82, 'description' => 'Set completo de manicura con 3 esmaltes ColorStay, base coat, top coat, removedor de cutículas, lima y cortauñas profesional', 'images' => ['https://m.media-amazon.com/images/I/71niOfqyIaL._AC_SX679_.jpg']],
            ['name' => 'Cepillo Eléctrico Oral-B Pro 1000', 'price' => 1099.00, 'stock_quantity' => 60, 'description' => 'Cepillo de dientes eléctrico recargable con sensor de presión 3D, tecnología de limpieza profunda, temporizador de 2 minutos, incluye 1 cabezal', 'images' => ['https://m.media-amazon.com/images/I/619CgrfN2BL._AC_SX679_.jpg']],
            ['name' => 'Mascarilla Facial Garnier SkinActive', 'price' => 99.00, 'stock_quantity' => 200, 'description' => 'Mascarilla purificante en hoja con carbón activado y ácido hialurónico, destapa poros, hidrata y refresca, uso único de 15 minutos', 'images' => ['https://m.media-amazon.com/images/I/41B2xRMRVOL._AC_SX522_.jpg']],
            ['name' => 'Depiladora Láser Philips Lumea Prestige', 'price' => 7999.00, 'stock_quantity' => 15, 'description' => 'Depiladora de luz pulsada IPL con sensor SmartSkin que detecta tono de piel, 4 accesorios especializados, 250,000 pulsos, hasta 92% menos vello', 'images' => ['https://m.media-amazon.com/images/I/61ZwtwSu5xL._AC_SY300_SX300_QL70_ML2_.jpg']],
        ];

        // Productos de Herramientas (10 productos) - Precios en MXN
        $herramientasProducts = [
            ['name' => 'Taladro Inalámbrico Bosch 20V Max', 'price' => 1799.00, 'stock_quantity' => 30, 'description' => 'Taladro percutor inalámbrico con batería de litio 2.0Ah, 13mm de portabrocas, 2 velocidades, luz LED, maletín rígido y cargador incluido', 'images' => ['https://m.media-amazon.com/images/I/71jmfMWg6qL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Juego de Llaves Combinadas 12 Piezas', 'price' => 499.00, 'stock_quantity' => 60, 'description' => 'Set de llaves combinadas métricas cromadas de 8mm a 19mm, acabado espejo, acero cromo-vanadio forjado, estuche organizador enrollable', 'images' => ['https://m.media-amazon.com/images/I/51eImbrEXUL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Sierra Circular Eléctrica 1400W', 'price' => 1299.00, 'stock_quantity' => 25, 'description' => 'Sierra circular con motor de 1400W, guía láser integrada, profundidad de corte ajustable hasta 65mm, disco de 185mm, base de aluminio fundido', 'images' => ['https://m.media-amazon.com/images/I/71WcjfAD8fL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Kit de Herramientas Mecánico 120 Piezas', 'price' => 899.00, 'stock_quantity' => 45, 'description' => 'Maletín profesional con dados, llaves, destornilladores, alicates y herramientas especializadas para mecánica automotriz, acero cromo-vanadio', 'images' => ['https://m.media-amazon.com/images/I/81lNhitd2KL._AC_SX679_.jpg']],
            ['name' => 'Amoladora Angular DeWalt 900W', 'price' => 1599.00, 'stock_quantity' => 32, 'description' => 'Esmeriladora angular de 4.5" (115mm) con motor de 900W, empuñadura lateral ajustable, protector sin herramientas, 11,000 RPM', 'images' => ['https://m.media-amazon.com/images/I/71Gweqn3eJL._AC_SX679_.jpg']],
            ['name' => 'Nivel Láser Stanley Cross90', 'price' => 1199.00, 'stock_quantity' => 38, 'description' => 'Nivel láser de líneas cruzadas autonivelante con rango de 15m, precisión ±3mm, soporte magnético incluido, funciona con baterías AA', 'images' => ['https://m.media-amazon.com/images/I/61fROQk9rSL._AC_SX679_.jpg']],
            ['name' => 'Soldadora Inverter 200A Profesional', 'price' => 2399.00, 'stock_quantity' => 18, 'description' => 'Soldadora eléctrica inverter portátil con display digital LCD, corriente regulable 20-200A, incluye careta, pinzas y electrodos, tecnología IGBT', 'images' => ['https://m.media-amazon.com/images/I/718zb4apanL._AC_SX300_SY300_QL70_ML2_.jpg']],
            ['name' => 'Compresor de Aire 50L 2HP', 'price' => 2999.00, 'stock_quantity' => 12, 'description' => 'Compresor de aire con motor de 2HP, tanque de 50 litros, presión máxima 115 PSI, manómetros duales, kit de 5 accesorios neumáticos', 'images' => ['https://m.media-amazon.com/images/I/61pgla1mHVL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Escalera Telescópica de Aluminio', 'price' => 1799.00, 'stock_quantity' => 22, 'description' => 'Escalera extensible multiposición hasta 3.8m, aleación de aluminio ligero, carga máxima 150kg, sistema de bloqueo de seguridad, pies antideslizantes', 'images' => ['https://m.media-amazon.com/images/I/61VgbmaqxAL._AC_SX679_.jpg']],
            ['name' => 'Pistola de Calor Black+Decker 1800W', 'price' => 699.00, 'stock_quantity' => 48, 'description' => 'Pistola de aire caliente industrial con motor de 1800W, 2 niveles de temperatura (400°C y 600°C), boquilla concentradora y difusora incluidas', 'images' => ['https://m.media-amazon.com/images/I/61ThdLQEgrL._AC_SX679_.jpg']],
        ];

        // Productos de Libros y Entretenimiento (10 productos) - Precios en MXN
        $librosProducts = [
            ['name' => 'Cien Años de Soledad - García Márquez', 'price' => 259.00, 'stock_quantity' => 100, 'description' => 'Edición de bolsillo del clásico de literatura latinoamericana, obra maestra del realismo mágico, 496 páginas, editorial Debolsillo', 'images' => ['https://m.media-amazon.com/images/I/71YoFJSz3LL._SY466_.jpg']],
            ['name' => 'PlayStation 5 Digital Edition', 'price' => 11999.00, 'stock_quantity' => 8, 'description' => 'Consola de videojuegos de nueva generación con SSD ultra rápido de 825GB, Ray Tracing, resolución 4K hasta 120fps, DualSense incluido', 'images' => ['https://m.media-amazon.com/images/I/81LqSOmQSKL._AC_SX342_SY445_QL70_ML2_.jpg']],
            ['name' => 'Guitarra Acústica Fender FA-125', 'price' => 3199.00, 'stock_quantity' => 18, 'description' => 'Guitarra acústica dreadnought de cuerdas de acero, tapa de pícea laminada, diapasón de nogal, sonido brillante, incluye funda acolchada', 'images' => ['https://m.media-amazon.com/images/I/51f45dnnEsL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Harry Potter Colección Completa', 'price' => 999.00, 'stock_quantity' => 65, 'description' => 'Box set con los 7 libros de la saga en tapa dura, edición especial ilustrada con arte original, incluye mapa del merodeador como regalo', 'images' => ['https://m.media-amazon.com/images/I/41XluB8LxmL._SY342_.jpg']],
            ['name' => 'Nintendo Switch OLED', 'price' => 7999.00, 'stock_quantity' => 15, 'description' => 'Consola híbrida con pantalla OLED de 7", 64GB almacenamiento interno, audio mejorado, base con puerto LAN, Joy-Con incluidos, dock HDMI', 'images' => ['https://m.media-amazon.com/images/I/71-wWSAhXfL._AC_SX679_.jpg']],
            ['name' => 'El Principito - Antoine de Saint-Exupéry', 'price' => 179.00, 'stock_quantity' => 150, 'description' => 'Edición ilustrada del clásico infantil con acuarelas originales del autor, traducción de Bonifacio del Carril, 96 páginas, tapa dura', 'images' => ['https://m.media-amazon.com/images/I/811kjwhnjcS._SY466_.jpg']],
            ['name' => 'Vinilo The Beatles Abbey Road', 'price' => 699.00, 'stock_quantity' => 42, 'description' => 'Vinilo LP remasterizado del icónico álbum de 1969, 180g de peso, incluye póster desplegable, sonido estéreo de alta fidelidad', 'images' => ['https://m.media-amazon.com/images/I/81g69A-vU4L._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Juego FIFA 24 PS5', 'price' => 1599.00, 'stock_quantity' => 50, 'description' => 'Simulador de fútbol con tecnología HyperMotionV, más de 700 equipos con licencias oficiales, modo carrera mejorado, Ultimate Team y VOLTA Football', 'images' => ['https://m.media-amazon.com/images/I/71zFBOOMoXL._AC_SX342_SY445_QL70_ML2_.jpg']],
            ['name' => 'Audífonos Inalámbricos JBL Tune 510BT', 'price' => 1199.00, 'stock_quantity' => 70, 'description' => 'Auriculares Bluetooth over-ear con sonido Pure Bass, hasta 40 horas de batería, carga rápida, micrófono integrado, plegables y portátiles', 'images' => ['https://m.media-amazon.com/images/I/61kFL7ywsZS._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => '1984 - George Orwell', 'price' => 219.00, 'stock_quantity' => 88, 'description' => 'Novela distópica clásica en edición de bolsillo, traducción de Miguel Temprano García, 352 páginas, editorial Debolsillo, incluye prólogo', 'images' => ['https://m.media-amazon.com/images/I/51rXrmHv51L._SY445_SX342_ML2_.jpg']],
        ];

        // Productos de Automotriz (10 productos) - Precios en MXN
        $automotrizProducts = [
            ['name' => 'Llanta Pirelli P4 185/65 R15', 'price' => 1099.00, 'stock_quantity' => 80, 'description' => 'Neumático para auto con compuesto de sílice para mejor tracción en mojado, diseño de banda de rodadura optimizado, construcción radial', 'images' => ['https://m.media-amazon.com/images/I/51ndDpcmqcL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Batería LTH L-42-500 12V 75Ah', 'price' => 1799.00, 'stock_quantity' => 35, 'description' => 'Batería libre de mantenimiento con tecnología de calcio-plata, 500 amperes de arranque en frío, 24 meses de garantía, compatible con la mayoría de vehículos', 'images' => ['https://m.media-amazon.com/images/I/51T5ezpw4mL._AC_SX300_SY300_QL70_ML2_.jpg']],
            ['name' => 'Limpia Parabrisas Bosch AeroTwin', 'price' => 379.00, 'stock_quantity' => 110, 'description' => 'Par de escobillas limpiaparabrisas premium con tecnología aerodinámica sin armazón, adaptador universal incluido, duración extendida', 'images' => ['https://m.media-amazon.com/images/I/71HKRzTzqTL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Aceite Castrol Edge 5W-30 4L', 'price' => 499.00, 'stock_quantity' => 120, 'description' => 'Aceite sintético para motor con tecnología Fluid Titanium, protección contra el desgaste, mejora la eficiencia del combustible, cumple normas API SN', 'images' => ['https://m.media-amazon.com/images/I/618lHxFf46L._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Aspiradora Auto Black+Decker 12V', 'price' => 699.00, 'stock_quantity' => 65, 'description' => 'Aspiradora portátil para auto con conexión a encendedor de 12V, accesorios para tapicería y ranuras, filtro lavable, cable de 5m, bolsa recolectora', 'images' => ['https://m.media-amazon.com/images/I/615efLXfL3L._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Cargador de Batería Inteligente 6A', 'price' => 599.00, 'stock_quantity' => 48, 'description' => 'Cargador automático de baterías con microcontrolador, corriente de 6A, protección contra sobrecarga y cortocircuito, para baterías 6V/12V', 'images' => ['https://m.media-amazon.com/images/I/713Q2Y+o5kL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Funda Cubre Asientos Universal', 'price' => 399.00, 'stock_quantity' => 95, 'description' => 'Set completo de fundas de poliéster resistente para 5 asientos: 2 delanteros y banco trasero, diseño universal, fácil instalación, lavables', 'images' => ['https://m.media-amazon.com/images/I/611Vw79wNqL._AC_SX300_SY300_QL70_ML2_.jpg']],
            ['name' => 'Cámara de Retroceso con Pantalla 4.3"', 'price' => 999.00, 'stock_quantity' => 38, 'description' => 'Sistema de visión trasera con monitor LCD a color de 4.3", cámara gran angular 170°, visión nocturna infrarroja, guías de estacionamiento', 'images' => ['https://m.media-amazon.com/images/I/61R0EGW-Q9L._AC_SX466_.jpg']],
            ['name' => 'Compresor de Aire Portátil 12V', 'price' => 799.00, 'stock_quantity' => 52, 'description' => 'Inflador de neumáticos digital portátil, conexión a encendedor 12V, manómetro digital LCD, presión máxima 150 PSI, incluye adaptadores múltiples', 'images' => ['https://m.media-amazon.com/images/I/71eHittCtZL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Pastillas de Freno Bosch Cerámicas', 'price' => 599.00, 'stock_quantity' => 72, 'description' => 'Juego de pastillas de freno cerámicas para eje delantero, baja emisión de polvo, bajo nivel de ruido, frenado suave y seguro, incluye sensores', 'images' => ['https://m.media-amazon.com/images/I/91yaAIc-PZL._AC_SX300_SY300_QL70_ML2_.jpg']],
        ];

        // Productos de Jardín y Exterior (10 productos) - Precios en MXN
        $jardinProducts = [
            ['name' => 'Cortacésped Eléctrico 1400W', 'price' => 3599.00, 'stock_quantity' => 18, 'description' => 'Cortadora de césped con motor eléctrico de 1400W, bolsa recolectora de 35L, ancho de corte 35cm, 5 niveles de altura ajustable, asa plegable', 'images' => ['https://m.media-amazon.com/images/I/61dObLyk2ML._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Set de Herramientas de Jardín 5 Piezas', 'price' => 499.00, 'stock_quantity' => 55, 'description' => 'Kit profesional con pala jardinera, rastrillo de mano, tijera de podar, transplantador y cepillo de limpieza, mangos ergonómicos antideslizantes', 'images' => ['https://m.media-amazon.com/images/I/61dRHB8eBOL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Manguera Extensible 30m con Pistola', 'price' => 299.00, 'stock_quantity' => 85, 'description' => 'Manguera de riego flexible que se expande hasta 30m, pistola multifunción con 7 patrones de rociado, conectores rápidos, material látex reforzado', 'images' => ['https://m.media-amazon.com/images/I/91dmtHHHTeL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Sombrilla de Jardín 3m Octogonal', 'price' => 1799.00, 'stock_quantity' => 25, 'description' => 'Parasol octogonal de 3 metros con manivela de apertura y cierre, protección UV 50+, estructura de aluminio, tela poliéster impermeable', 'images' => ['https://m.media-amazon.com/images/I/51J0wk8yLUL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Macetas de Fibrocemento Set 3 Piezas', 'price' => 699.00, 'stock_quantity' => 42, 'description' => 'Set de 3 macetas decorativas en tamaños graduados (grande, mediano, chico), material fibrocemento resistente a intemperie, drenaje inferior', 'images' => ['https://m.media-amazon.com/images/I/81533Jo4jXL._AC_SX679_.jpg']],
            ['name' => 'Bordeadora Eléctrica 450W', 'price' => 1199.00, 'stock_quantity' => 32, 'description' => 'Recortadora de bordes con motor de 450W, cabezal giratorio de 90°, ancho de corte 25cm, protector de seguridad, carrete de hilo automático', 'images' => ['https://m.media-amazon.com/images/I/51gz9EjUQDL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Sistema de Riego Automático por Goteo', 'price' => 1599.00, 'stock_quantity' => 28, 'description' => 'Kit de riego por goteo con temporizador digital programable, 20m de manguera, 20 goteros ajustables, conectores y estacas, para hasta 20 plantas', 'images' => ['https://m.media-amazon.com/images/I/81VnQiw+1GL._AC_SX300_SY300_QL70_ML2_.jpg']],
            ['name' => 'Parrilla Weber a Carbón 57cm', 'price' => 2599.00, 'stock_quantity' => 20, 'description' => 'Parrilla tipo kettle redonda de 57cm con tapa esmaltada, termómetro integrado, rejilla de cocción cromada, cenicero extraíble, ruedas resistentes', 'images' => ['https://m.media-amazon.com/images/I/71BJW1z7i2L._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Luces Solares de Jardín Pack 8', 'price' => 399.00, 'stock_quantity' => 70, 'description' => 'Set de 8 estacas LED solares para jardín con panel solar individual, sensor de luz automático, resistentes al agua IP65, luz blanca cálida', 'images' => ['https://m.media-amazon.com/images/I/71oq3hjBsYL._AC_SX342_SY445_QL70_ML2_.jpg']],
            ['name' => 'Compostadora 300L Ecológica', 'price' => 899.00, 'stock_quantity' => 15, 'description' => 'Compostera de plástico reciclado de 300 litros, sistema de ventilación optimizado, compuertas de acceso superior y lateral, tapa con bisagras', 'images' => ['https://m.media-amazon.com/images/I/71LWSF0vwFL._AC_SY300_SX300_QL70_ML2_.jpg']],
        ];

        // Productos de Alimentos y Bebidas (10 productos) - Precios en MXN
        $alimentosProducts = [
            ['name' => 'Café Chiapas Orgánico 1kg', 'price' => 259.00, 'stock_quantity' => 120, 'description' => 'Café molido premium de origen Chiapas, tueste medio ideal para espresso y cafetera, certificación orgánica, notas de chocolate y nuez', 'images' => ['https://m.media-amazon.com/images/I/81eqYzwWrNL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Aceite de Oliva Extra Virgen 750ml', 'price' => 499.00, 'stock_quantity' => 85, 'description' => 'Aceite de oliva extra virgen primera presión en frío, origen mediterráneo, acidez menor a 0.5%, ideal para ensaladas y cocina saludable', 'images' => ['https://m.media-amazon.com/images/I/61EURiNkPWL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Cajeta Coronado 450g', 'price' => 179.00, 'stock_quantity' => 150, 'description' => 'Cajeta tradicional mexicana de leche de cabra con textura cremosa, sabor caramelizado auténtico, preparación artesanal de Celaya', 'images' => ['https://m.media-amazon.com/images/I/51myA2xiZqL._AC_SX679_.jpg']],
            ['name' => 'Tequila José Cuervo Especial Reposado', 'price' => 699.00, 'stock_quantity' => 60, 'description' => 'Tequila reposado 100% agave azul 750ml, añejado en barricas de roble blanco, notas suaves de vainilla, ideal para coctelería premium', 'images' => ['https://m.media-amazon.com/images/I/31a365-gysL._SX342_SY445_QL70_ML2_.jpg']],
            ['name' => 'Chocolate Turin 70% Cacao', 'price' => 139.00, 'stock_quantity' => 200, 'description' => 'Tableta de chocolate amargo mexicano 100g con 70% cacao, notas intensas y amargas, cacao de origen Tabasco, sin gluten', 'images' => ['https://m.media-amazon.com/images/I/61rwVCZO+LL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Miel Multifloral Orgánica 500g', 'price' => 299.00, 'stock_quantity' => 95, 'description' => 'Miel de flores silvestres orgánica de Yucatán, sin pasteurizar ni aditivos, producción sustentable, cristalización natural', 'images' => ['https://m.media-amazon.com/images/I/71DfXJqAvPL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Té de Jamaica Premium', 'price' => 119.00, 'stock_quantity' => 180, 'description' => 'Té de flor de jamaica en saquitos filtrantes, rico en antioxidantes, 25 sobres individuales, sabor natural sin azúcar, producto mexicano', 'images' => ['https://m.media-amazon.com/images/I/614d78eR23L._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Mermelada Artesanal de Fresa 400g', 'price' => 199.00, 'stock_quantity' => 110, 'description' => 'Mermelada casera de fresa de Irapuato con 60% de fruta natural, sin conservadores artificiales, endulzada con azúcar de caña', 'images' => ['https://m.media-amazon.com/images/I/61cGs+MWYTL._AC_SX679_.jpg']],
            ['name' => 'Chiles Jalapeños en Escabeche 500g', 'price' => 159.00, 'stock_quantity' => 140, 'description' => 'Chiles jalapeños en rodajas con zanahorias y especias en escabeche, sabor tradicional mexicano, frasco de vidrio, listo para consumir', 'images' => ['https://m.media-amazon.com/images/I/71AUVIOK6rL._AC_SY300_SX300_QL70_ML2_.jpg']],
            ['name' => 'Salsa Valentina 370ml', 'price' => 99.00, 'stock_quantity' => 250, 'description' => 'Salsa picante mexicana tradicional con chiles y especias, sabor equilibrado con toque de limón, etiqueta negra extra picante', 'images' => ['https://m.media-amazon.com/images/I/41qAfWHmvlL._AC_SY300_SX300_QL70_ML2_.jpg']],
        ];

        // Crear todos los productos
        $allProducts = [
            [$techProducts, $tecnologia],
            [$electroProducts, $electrodomesticos],
            [$hogarProducts, $hogar],
            [$modaProducts, $moda],
            [$deportesProducts, $deportes],
            [$juguetesProducts, $juguetes],
            [$bellezaProducts, $belleza],
            [$herramientasProducts, $herramientas],
            [$librosProducts, $libros],
            [$automotrizProducts, $automotriz],
            [$jardinProducts, $jardin],
            [$alimentosProducts, $alimentos],
        ];

        foreach ($allProducts as [$products, $category]) {
            if (!$category) continue;
            
            foreach ($products as $productData) {
                // Generar slug único basado en el nombre
                $baseSlug = \Illuminate\Support\Str::slug($productData['name']);
                $slug = $baseSlug;
                $counter = 1;
                
                while (Product::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }
                
                // Generar SKU único
                $sku = 'ML-' . strtoupper(substr($category->name, 0, 3)) . '-' . rand(10000, 99999);
                while (Product::where('sku', $sku)->exists()) {
                    $sku = 'ML-' . strtoupper(substr($category->name, 0, 3)) . '-' . rand(10000, 99999);
                }
                
                // Normalize price values from seed data
                $rawPrice = $productData['price'] ?? 0;
                $price = (float) $rawPrice;
                // Si el precio parece estar en centavos (mayor a 50000), dividir por 100
                if ($price > 50000) {
                    $price = $price / 100.0;
                }

                // Generar especificaciones según la categoría
                $specifications = $this->generateSpecifications($category->name, $productData['name']);

                // Asignar a la subcategoría correcta basándose en el nombre del producto
                $assignedCategoryId = $this->getCorrectSubcategory($category, $productData['name']);

                // 30% de probabilidad de tener descuento
                $hasDiscount = rand(1, 100) <= 30;
                $salePrice = null;
                
                if ($hasDiscount) {
                    // Descuento entre 10% y 50%
                    $discountPercent = rand(10, 50);
                    $salePrice = round($price * (1 - $discountPercent / 100), 2);
                }

                Product::create([
                    'name' => $productData['name'],
                    'slug' => $slug,
                    'description' => $productData['description'],
                    'short_description' => substr($productData['description'], 0, 150),
                    'specifications' => $specifications,
                    'sku' => $sku,
                    'price' => round($price, 2),
                    'sale_price' => $salePrice,
                    'stock_quantity' => $productData['stock_quantity'],
                    'category_id' => $assignedCategoryId,
                    'user_id' => $sellers->random()->id, // Asignar solo a vendedores
                    'images' => isset($productData['images']) ? $productData['images'] : ['images/placeholder-product.svg'],
                    'is_active' => true,
                    'is_featured' => rand(1, 100) <= 20, // 20% de productos destacados
                ]);
            }
        }
    }

    private function generateSpecifications($categoryName, $productName)
    {
        $specs = [];

        switch($categoryName) {
            case 'Tecnología':
                if (str_contains($productName, 'Laptop') || str_contains($productName, 'MacBook')) {
                    $specs = [
                        'Procesador' => ['Intel Core i5', 'Intel Core i7', 'AMD Ryzen 5', 'Apple M1', 'Apple M2'][rand(0, 4)],
                        'RAM' => ['8GB', '16GB', '32GB'][rand(0, 2)],
                        'Almacenamiento' => ['256GB SSD', '512GB SSD', '1TB SSD'][rand(0, 2)],
                        'Pantalla' => ['13.3"', '14"', '15.6"', '16"'][rand(0, 3)],
                        'Peso' => rand(12, 22) / 10 . ' kg',
                    ];
                } elseif (str_contains($productName, 'Phone') || str_contains($productName, 'Galaxy') || str_contains($productName, 'iPhone')) {
                    $specs = [
                        'Pantalla' => ['6.1"', '6.4"', '6.7"'][rand(0, 2)] . ' AMOLED',
                        'Cámara Principal' => ['48MP', '50MP', '64MP', '108MP'][rand(0, 3)],
                        'Batería' => rand(4000, 5500) . ' mAh',
                        'Almacenamiento' => ['64GB', '128GB', '256GB', '512GB'][rand(0, 3)],
                        'RAM' => ['4GB', '6GB', '8GB', '12GB'][rand(0, 3)],
                    ];
                } elseif (str_contains($productName, 'TV')) {
                    $specs = [
                        'Tamaño' => ['43"', '50"', '55"', '65"'][rand(0, 3)],
                        'Resolución' => ['Full HD 1080p', '4K UHD', '8K'][rand(0, 2)],
                        'Tecnología' => ['LED', 'QLED', 'OLED'][rand(0, 2)],
                        'Smart TV' => 'Sí',
                        'Conectividad' => 'WiFi, Bluetooth, HDMI x3, USB x2',
                    ];
                } else {
                    $specs = [
                        'Marca' => ['Samsung', 'Apple', 'Sony', 'LG', 'Logitech'][rand(0, 4)],
                        'Garantía' => '1 año',
                        'Color' => ['Negro', 'Blanco', 'Gris', 'Azul'][rand(0, 3)],
                    ];
                }
                break;

            case 'Electrodomésticos':
                $specs = [
                    'Capacidad' => rand(10, 50) . ' litros',
                    'Potencia' => rand(800, 2000) . 'W',
                    'Voltaje' => '110-220V',
                    'Dimensiones' => rand(40, 80) . ' x ' . rand(40, 60) . ' x ' . rand(30, 50) . ' cm',
                    'Peso' => rand(5, 25) . ' kg',
                    'Garantía' => '1 año',
                    'Color' => ['Blanco', 'Acero Inoxidable', 'Negro'][rand(0, 2)],
                ];
                break;

            case 'Hogar y Muebles':
                $specs = [
                    'Material' => ['Madera', 'Metal', 'Tela', 'Cuero sintético'][rand(0, 3)],
                    'Dimensiones' => rand(100, 200) . ' x ' . rand(40, 100) . ' x ' . rand(40, 90) . ' cm',
                    'Peso' => rand(5, 30) . ' kg',
                    'Color' => ['Blanco', 'Negro', 'Gris', 'Beige', 'Café'][rand(0, 4)],
                    'Estilo' => ['Moderno', 'Minimalista', 'Industrial', 'Clásico'][rand(0, 3)],
                ];
                break;

            case 'Moda':
                $specs = [
                    'Material' => ['100% Algodón', 'Poliéster', 'Cuero', 'Mezclilla'][rand(0, 3)],
                    'Tallas Disponibles' => 'XS, S, M, L, XL, XXL',
                    'Género' => ['Unisex', 'Hombre', 'Mujer'][rand(0, 2)],
                    'Cuidados' => 'Lavar a máquina en frío',
                    'Origen' => ['México', 'USA', 'China', 'Vietnam'][rand(0, 3)],
                ];
                break;

            case 'Deportes y Fitness':
                $specs = [
                    'Material' => ['Acero', 'Aluminio', 'Fibra de Carbono', 'Goma'][rand(0, 3)],
                    'Peso' => rand(1, 20) . ' kg',
                    'Dimensiones' => rand(20, 150) . ' x ' . rand(10, 80) . ' x ' . rand(5, 40) . ' cm',
                    'Uso' => ['Profesional', 'Amateur', 'Principiante'][rand(0, 2)],
                    'Color' => ['Negro', 'Azul', 'Rojo', 'Verde'][rand(0, 3)],
                ];
                break;

            case 'Juguetes y Bebés':
                $specs = [
                    'Edad Recomendada' => rand(0, 12) . '+ años',
                    'Material' => ['Plástico ABS', 'Madera', 'Tela', 'Silicona'][rand(0, 3)],
                    'Dimensiones' => rand(10, 60) . ' x ' . rand(10, 40) . ' x ' . rand(5, 30) . ' cm',
                    'Peso' => rand(100, 3000) / 100 . ' kg',
                    'Seguridad' => 'Certificado libre de BPA',
                ];
                break;

            case 'Belleza y Cuidado Personal':
                $specs = [
                    'Contenido' => rand(50, 500) . 'ml',
                    'Tipo de Piel' => ['Todo tipo', 'Grasa', 'Seca', 'Mixta'][rand(0, 3)],
                    'Ingredientes' => 'Ingredientes naturales',
                    'Uso' => 'Uso diario',
                    'Libre de' => 'Parabenos, Sulfatos',
                ];
                break;

            case 'Herramientas':
                $specs = [
                    'Tipo' => ['Manual', 'Eléctrica', 'Inalámbrica'][rand(0, 2)],
                    'Potencia' => rand(500, 2000) . 'W',
                    'Voltaje' => '110-220V',
                    'Peso' => rand(1, 8) . ' kg',
                    'Material' => ['Acero Inoxidable', 'Acero al Carbono', 'Aluminio'][rand(0, 2)],
                ];
                break;

            case 'Libros y Entretenimiento':
                $specs = [
                    'Formato' => ['Físico', 'Digital', 'Blu-ray', 'DVD'][rand(0, 3)],
                    'Idioma' => ['Español', 'Inglés', 'Subtitulado'][rand(0, 2)],
                    'Duración/Páginas' => rand(100, 500),
                    'Clasificación' => ['A', 'B', 'C', 'D'][rand(0, 3)],
                ];
                break;

            case 'Automotriz':
                $specs = [
                    'Material' => ['Plástico ABS', 'Metal', 'Aluminio'][rand(0, 2)],
                    'Compatible con' => 'Vehículos universales',
                    'Garantía' => '6 meses',
                    'Instalación' => 'Fácil instalación',
                ];
                break;

            case 'Jardín y Exterior':
                $specs = [
                    'Material' => ['Plástico', 'Metal', 'Madera'][rand(0, 2)],
                    'Dimensiones' => rand(30, 120) . ' x ' . rand(30, 80) . ' x ' . rand(20, 100) . ' cm',
                    'Resistente al Agua' => 'Sí',
                    'Uso' => 'Interior/Exterior',
                ];
                break;

            case 'Alimentos y Bebidas':
                $specs = [
                    'Contenido Neto' => rand(100, 1000) . 'g',
                    'Presentación' => ['Frasco', 'Bolsa', 'Lata', 'Botella'][rand(0, 3)],
                    'Caducidad' => rand(6, 24) . ' meses',
                    'Almacenamiento' => 'Lugar fresco y seco',
                ];
                break;

            default:
                $specs = [
                    'Material' => 'Material de calidad',
                    'Garantía' => '6 meses',
                    'Color' => ['Negro', 'Blanco', 'Gris'][rand(0, 2)],
                ];
        }

        return $specs;
    }

    private function getCorrectSubcategory($parentCategory, $productName)
    {
        $productNameLower = strtolower($productName);
        
        // Mapeo de palabras clave a subcategorías
        $mappings = [
            'Tecnología' => [
                'Celulares y Smartphones' => ['iphone', 'galaxy', 'smartphone', 'celular', 'móvil', 'phone'],
                'Computadoras y Laptops' => ['laptop', 'macbook', 'computadora', 'pc', 'notebook', 'dell', 'hp', 'lenovo'],
                'Tablets' => ['tablet', 'ipad'],
                'Accesorios Tecnológicos' => ['auricular', 'mouse', 'teclado', 'cargador', 'cable', 'funda', 'protector'],
                'Cámaras y Fotografía' => ['cámara', 'canon', 'nikon', 'gopro', 'fotografía'],
                'Audio y Video' => ['bocina', 'parlante', 'speaker', 'soundbar', 'proyector'],
            ],
            'Electrodomésticos' => [
                'Refrigeración' => ['refrigerador', 'heladera', 'nevera', 'congelador'],
                'Lavado y Secado' => ['lavadora', 'secadora', 'lavarropas'],
                'Cocina' => ['microondas', 'horno', 'estufa', 'licuadora', 'batidora', 'tostador', 'cafetera'],
                'Climatización' => ['aire acondicionado', 'ventilador', 'calefactor', 'climatizador'],
                'Pequeños Electrodomésticos' => ['plancha', 'aspiradora', 'procesador'],
            ],
            'Hogar y Muebles' => [
                'Muebles de Sala' => ['sofá', 'sillón', 'sala', 'mesa de centro'],
                'Muebles de Dormitorio' => ['cama', 'colchón', 'buró', 'closet', 'recámara'],
                'Muebles de Comedor' => ['comedor', 'silla', 'mesa comedor'],
                'Decoración' => ['lámpara', 'espejo', 'cuadro', 'florero', 'jarrón'],
                'Textiles para el Hogar' => ['cortina', 'almohada', 'sábana', 'edredón', 'cobija'],
                'Organización' => ['estante', 'organizador', 'caja', 'contenedor'],
            ],
            'Moda' => [
                'Ropa de Hombre' => ['camisa hombre', 'pantalón hombre', 'traje', 'corbata'],
                'Ropa de Mujer' => ['blusa', 'vestido', 'falda', 'pantalón mujer'],
                'Ropa de Niños' => ['niño', 'niña', 'infantil', 'bebé ropa'],
                'Calzado' => ['zapato', 'tenis', 'sandalia', 'bota', 'zapatilla'],
                'Accesorios y Joyería' => ['bolsa', 'cartera', 'collar', 'pulsera', 'anillo', 'aretes'],
                'Relojes' => ['reloj'],
            ],
            'Deportes y Fitness' => [
                'Fitness y Gimnasio' => ['pesa', 'mancuerna', 'barra', 'gimnasio', 'caminadora', 'bicicleta estática'],
                'Deportes al Aire Libre' => ['pelota', 'balón', 'fútbol', 'basketball', 'camping', 'tienda campaña'],
                'Bicicletas y Ciclismo' => ['bicicleta', 'casco ciclismo'],
                'Deportes Acuáticos' => ['natación', 'traje baño', 'goggles', 'flotador'],
                'Ropa Deportiva' => ['pants', 'short deportivo', 'jersey', 'playera deportiva'],
            ],
            'Juguetes y Bebés' => [
                'Juguetes para Bebés' => ['sonajero', 'móvil', 'gimnasio bebé'],
                'Juguetes Educativos' => ['rompecabezas', 'bloques', 'educativo'],
                'Muñecas y Accesorios' => ['muñeca', 'barbie', 'casa muñecas'],
                'Vehículos y Pistas' => ['carro juguete', 'pista', 'hot wheels'],
                'Artículos para Bebés' => ['pañalera', 'biberón', 'carriola', 'cuna', 'andadera'],
            ],
            'Belleza y Cuidado Personal' => [
                'Fragancias' => ['perfume', 'fragancia', 'colonia'],
                'Maquillaje' => ['labial', 'máscara', 'base', 'maquillaje', 'sombra'],
                'Cuidado de la Piel' => ['crema facial', 'serum', 'limpiador', 'exfoliante', 'bloqueador'],
                'Cuidado del Cabello' => ['shampoo', 'acondicionador', 'tinte', 'tratamiento capilar'],
                'Cuidado Personal' => ['cepillo dental', 'rasuradora', 'secadora cabello', 'plancha pelo'],
            ],
            'Herramientas' => [
                'Herramientas Manuales' => ['martillo', 'destornillador', 'llave', 'alicate', 'pinza'],
                'Herramientas Eléctricas' => ['taladro', 'sierra eléctrica', 'lijadora', 'esmeril'],
                'Herramientas de Jardín' => ['podadora', 'rastrillo', 'pala', 'manguera'],
                'Equipamiento Industrial' => ['compresor', 'soldadora', 'generador'],
            ],
            'Libros y Entretenimiento' => [
                'Libros' => ['libro', 'novela', 'enciclopedia'],
                'Música' => ['cd', 'vinilo', 'álbum musical'],
                'Películas y Series' => ['dvd', 'blu-ray', 'película'],
                'Videojuegos' => ['videojuego', 'playstation', 'xbox', 'nintendo', 'switch'],
                'Instrumentos Musicales' => ['guitarra', 'piano', 'batería', 'violín'],
            ],
            'Automotriz' => [
                'Accesorios para Auto' => ['tapete', 'funda asiento', 'organizador auto'],
                'Repuestos' => ['filtro', 'aceite', 'bujía', 'balata'],
                'Herramientas Automotrices' => ['gato hidráulico', 'llave torque', 'compresor'],
                'Audio y Video para Auto' => ['stereo', 'bocina auto', 'cámara reversa'],
            ],
            'Jardín y Exterior' => [
                'Plantas y Semillas' => ['planta', 'semilla', 'árbol', 'flor'],
                'Herramientas de Jardín' => ['podadora', 'tijera jardinería', 'regadera'],
                'Muebles de Exterior' => ['mesa jardín', 'silla exterior', 'hamaca'],
                'Decoración de Jardín' => ['maceta', 'fuente', 'gnomo', 'estatua'],
            ],
            'Alimentos y Bebidas' => [
                'Alimentos Frescos' => ['fruta', 'verdura', 'carne', 'pescado'],
                'Bebidas' => ['refresco', 'jugo', 'agua', 'cerveza', 'vino'],
                'Snacks y Dulces' => ['chocolate', 'galleta', 'dulce', 'papas', 'chips'],
                'Productos Gourmet' => ['gourmet', 'orgánico', 'premium', 'importado'],
            ],
        ];

        // Buscar la subcategoría correcta
        if (isset($mappings[$parentCategory->name])) {
            foreach ($mappings[$parentCategory->name] as $subcategoryName => $keywords) {
                foreach ($keywords as $keyword) {
                    if (str_contains($productNameLower, $keyword)) {
                        $subcategory = Category::where('parent_id', $parentCategory->id)
                            ->where('name', $subcategoryName)
                            ->first();
                        
                        if ($subcategory) {
                            return $subcategory->id;
                        }
                    }
                }
            }
        }

        // Si no se encuentra una subcategoría específica, usar la primera disponible o la categoría principal
        $firstSubcategory = Category::where('parent_id', $parentCategory->id)->first();
        return $firstSubcategory ? $firstSubcategory->id : $parentCategory->id;
    }
}


