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
        
        $users = User::all();
        
        // Productos de Tecnología (10 productos) - Precios en MXN
        $techProducts = [
            ['name' => 'Samsung Galaxy A54 5G 128GB', 'price' => 7899.00, 'stock_quantity' => 45, 'description' => 'Smartphone Samsung Galaxy A54 con pantalla AMOLED de 6.4", cámara triple de 50MP, batería de 5000mAh y carga rápida de 25W'],
            ['name' => 'iPhone 13 128GB', 'price' => 15999.00, 'stock_quantity' => 20, 'description' => 'Apple iPhone 13 con chip A15 Bionic, sistema de cámara dual de 12MP, pantalla Super Retina XDR de 6.1" y resistencia al agua IP68'],
            ['name' => 'Laptop Lenovo IdeaPad 3 15.6"', 'price' => 9899.00, 'stock_quantity' => 30, 'description' => 'Laptop con procesador Intel Core i5 de 11va generación, 8GB RAM DDR4, SSD 256GB NVMe, Windows 11 Home y pantalla FHD'],
            ['name' => 'Audífonos Sony WH-1000XM4', 'price' => 5499.00, 'stock_quantity' => 60, 'description' => 'Audífonos inalámbricos con cancelación de ruido activa líder en la industria, hasta 30 horas de batería, Bluetooth multipoint y audio Hi-Res'],
            ['name' => 'Tablet Samsung Galaxy Tab A8', 'price' => 3899.00, 'stock_quantity' => 35, 'description' => 'Tablet de 10.5" con procesador octa-core, 4GB RAM, 64GB almacenamiento expandible, batería de 7040mAh y sonido Dolby Atmos'],
            ['name' => 'Smart TV LG 50" 4K UHD', 'price' => 8999.00, 'stock_quantity' => 25, 'description' => 'Smart TV LED 50 pulgadas con resolución 4K Real, sistema operativo WebOS 22, HDR10, procesador α5 Gen5 AI y Magic Remote incluido'],
            ['name' => 'MacBook Air M2 256GB', 'price' => 24999.00, 'stock_quantity' => 12, 'description' => 'MacBook Air con chip M2 de Apple, pantalla Liquid Retina de 13.6", 8GB memoria unificada, SSD de 256GB, hasta 18 horas de batería'],
            ['name' => 'Mouse Logitech MX Master 3', 'price' => 1899.00, 'stock_quantity' => 80, 'description' => 'Mouse inalámbrico ergonómico con sensor de alta precisión de 4000 DPI, 7 botones personalizables, rueda electromagnética y hasta 70 días de batería'],
            ['name' => 'Teclado Mecánico Razer BlackWidow V3', 'price' => 2599.00, 'stock_quantity' => 40, 'description' => 'Teclado mecánico gaming con switches mecánicos Razer Green, iluminación RGB Chroma personalizable, reposamuñecas ergonómico y teclas programables'],
            ['name' => 'Webcam Logitech C920 HD Pro', 'price' => 1499.00, 'stock_quantity' => 55, 'description' => 'Cámara web Full HD 1080p a 30fps, enfoque automático HD, corrección de iluminación automática, micrófono estéreo integrado, compatible con Windows y Mac'],
        ];

        // Productos de Electrodomésticos (10 productos) - Precios en MXN
        $electroProducts = [
            ['name' => 'Refrigerador Whirlpool No Frost 340L', 'price' => 12999.00, 'stock_quantity' => 15, 'description' => 'Refrigerador con freezer, tecnología No Frost, eficiencia energética A+, control de temperatura digital y dispensador de agua'],
            ['name' => 'Lavadora Samsung 17kg Carga Frontal', 'price' => 8999.00, 'stock_quantity' => 20, 'description' => 'Lavadora automática carga frontal con 12 programas de lavado, display digital LED, tecnología Eco Bubble y tambor Diamond Drum'],
            ['name' => 'Microondas Mabe 23L', 'price' => 1899.00, 'stock_quantity' => 40, 'description' => 'Microondas con grill, 800W de potencia, 8 niveles de potencia, plato giratorio de cristal y función de descongelación automática'],
            ['name' => 'Aire Acondicionado Split 3000W', 'price' => 7899.00, 'stock_quantity' => 18, 'description' => 'Aire acondicionado frío/calor con gas ecológico R410A, control remoto, modo Sleep, temporizador 24hrs y filtro lavable'],
            ['name' => 'Licuadora Oster Reversible', 'price' => 1299.00, 'stock_quantity' => 65, 'description' => 'Licuadora de 600W con sistema de aspas reversibles, jarra de vidrio de 1.5L, 5 velocidades y función para picar hielo'],
            ['name' => 'Cafetera Express Oster Prima Latte', 'price' => 2999.00, 'stock_quantity' => 30, 'description' => 'Cafetera espresso con bomba italiana de 15 bares, vaporizador para capuccinos, bandeja antigoteo y portafiltros con doble salida'],
            ['name' => 'Aspiradora Robot iRobot Roomba', 'price' => 7999.00, 'stock_quantity' => 22, 'description' => 'Aspiradora robot inteligente con sistema de navegación iAdapt, mapeo Smart Mapping, app móvil iRobot Home y base de recarga automática'],
            ['name' => 'Horno Eléctrico Hamilton Beach 42L', 'price' => 2399.00, 'stock_quantity' => 28, 'description' => 'Horno eléctrico con parrilla rotisería, luz interior, bandeja para hornear, función de convección y temporizador de 60 minutos'],
            ['name' => 'Plancha de Vapor Black+Decker', 'price' => 699.00, 'stock_quantity' => 90, 'description' => 'Plancha a vapor de 1200W con suela antiadherente SmartSteam, sistema antigoteo, rocío nebulizador y cable giratorio 360°'],
            ['name' => 'Ventilador de Pedestal Lasko 20"', 'price' => 899.00, 'stock_quantity' => 75, 'description' => 'Ventilador de pedestal de 20" con 3 velocidades, altura regulable de 1.10m a 1.35m, oscilación automática y motor silencioso'],
        ];

        // Productos de Hogar y Muebles (10 productos) - Precios en MXN
        $hogarProducts = [
            ['name' => 'Juego de Sábanas 2 Plazas Matrimonial', 'price' => 499.00, 'stock_quantity' => 80, 'description' => 'Juego de sábanas 100% algodón egipcio de 300 hilos, incluye 1 sábana ajustable, 1 sábana plana y 2 fundas para almohada, varios colores disponibles'],
            ['name' => 'Comedor de Madera para 6 Personas', 'price' => 3199.00, 'stock_quantity' => 12, 'description' => 'Mesa rectangular de madera de pino con acabado natural laqueado, incluye 6 sillas tapizadas con respaldo ergonómico, dimensiones 180x90cm'],
            ['name' => 'Sillón Reclinable Relax', 'price' => 4599.00, 'stock_quantity' => 10, 'description' => 'Sillón reclinable individual tapizado en piel sintética premium, reposapiés extensible, palanca lateral de ajuste, estructura de acero reforzado'],
            ['name' => 'Lámpara de Piso LED Moderna', 'price' => 699.00, 'stock_quantity' => 55, 'description' => 'Lámpara de pie minimalista con brazo ajustable, foco LED de 12W incluido, dimmer touch integrado, acabado en negro mate'],
            ['name' => 'Tapete Shaggy Pelo Alto 160x230cm', 'price' => 1799.00, 'stock_quantity' => 35, 'description' => 'Alfombra suave de pelo alto de 5cm, fibra sintética antialérgica, base antideslizante, fácil limpieza, disponible en gris, beige y blanco'],
            ['name' => 'Espejo Decorativo Dorado 80cm', 'price' => 1099.00, 'stock_quantity' => 42, 'description' => 'Espejo de pared redondo con marco de metal acabado dorado, 80cm de diámetro, cristal de 4mm, soporte de montaje incluido, estilo moderno'],
            ['name' => 'Juego de Toallas 6 Piezas Premium', 'price' => 379.00, 'stock_quantity' => 95, 'description' => 'Set de toallas 100% algodón turco de 600 gsm: 2 toallas de baño (70x140cm), 2 toallas de manos (50x90cm) y 2 toallas faciales (30x30cm)'],
            ['name' => 'Cortinas Blackout Térmicas', 'price' => 599.00, 'stock_quantity' => 60, 'description' => 'Cortinas opacas con aislamiento térmico, bloquean 99% de luz, con ojillos metálicos, 140x220cm, disponibles en varios colores'],
            ['name' => 'Perchero de Piso Moderno', 'price' => 399.00, 'stock_quantity' => 70, 'description' => 'Perchero minimalista de madera de haya con 8 ganchos de metal, base circular pesada para mayor estabilidad, altura 175cm, fácil armado'],
            ['name' => 'Cojines Decorativos Premium Set 4', 'price' => 299.00, 'stock_quantity' => 88, 'description' => 'Set de 4 cojines decorativos 45x45cm con fundas removibles de algodón, relleno de fibra siliconada, cierre oculto, patrones modernos'],
        ];

        // Productos de Moda (10 productos) - Precios en MXN
        $modaProducts = [
            ['name' => 'Tenis Nike Air Max 90', 'price' => 2599.00, 'stock_quantity' => 65, 'description' => 'Tenis deportivos con tecnología Air Max visible, diseño retro urbano, suela de goma duradera, upper de malla y cuero sintético, varios colores'],
            ['name' => 'Jeans Levi\'s 501 Original Fit', 'price' => 1599.00, 'stock_quantity' => 90, 'description' => 'Jeans clásicos de corte recto, 100% algodón denim índigo, botón de cierre, 5 bolsillos, diseño atemporal desde 1873'],
            ['name' => 'Chamarra The North Face Impermeable', 'price' => 3799.00, 'stock_quantity' => 30, 'description' => 'Chamarra con capucha ajustable, aislamiento térmico DryVent, costuras selladas, bolsillos con zipper, ideal para clima frío y lluvioso'],
            ['name' => 'Playera Adidas Originals Trefoil', 'price' => 599.00, 'stock_quantity' => 120, 'description' => 'Playera de algodón 100%, logo Trefoil clásico bordado al frente, corte regular, cuello redondo, disponible en varios colores'],
            ['name' => 'Vestido Zara Estampado Floral', 'price' => 999.00, 'stock_quantity' => 45, 'description' => 'Vestido midi con estampado de flores, mangas cortas, cinturón desmontable, forro interior, cierre lateral con cremallera, estilo romántico'],
            ['name' => 'Sudadera Puma con Capucha', 'price' => 1199.00, 'stock_quantity' => 78, 'description' => 'Sudadera con capucha ajustable, bolsillo canguro, logo Puma cat bordado, mezcla de algodón y poliéster, ajuste cómodo'],
            ['name' => 'Botas Dr. Martens 1460 Cuero', 'price' => 3399.00, 'stock_quantity' => 35, 'description' => 'Botas icónicas de cuero genuino Nappa, suela AirWair con tecnología de absorción de impactos, 8 ojales, costura amarilla distintiva'],
            ['name' => 'Gorra New Era 9FIFTY Yankees', 'price' => 499.00, 'stock_quantity' => 100, 'description' => 'Gorra snapback ajustable, logo NY bordado frontal, visera plana, 80% acrílico 20% lana, diseño clásico oficial MLB'],
            ['name' => 'Reloj Casio G-Shock GA-2100', 'price' => 1799.00, 'stock_quantity' => 52, 'description' => 'Reloj digital-analógico resistente al agua 200m, estructura Carbon Core Guard, cronómetro, alarma, luz LED, batería de 3 años'],
            ['name' => 'Mochila Eastpak Padded Pak\'r', 'price' => 899.00, 'stock_quantity' => 85, 'description' => 'Mochila urbana de 24L, compartimento acolchado para laptop 13", bolsillo frontal, correas acolchadas, 30 años de garantía, 100% nylon'],
        ];

        // Productos de Deportes y Fitness (10 productos) - Precios en MXN
        $deportesProducts = [
            ['name' => 'Bicicleta Mountain Bike R29', 'price' => 6999.00, 'stock_quantity' => 15, 'description' => 'Bicicleta todo terreno rodada 29 con cambios Shimano 21 velocidades, suspensión delantera y frenos de disco mecánicos, cuadro de aluminio'],
            ['name' => 'Pelota de Fútbol Nike Strike', 'price' => 399.00, 'stock_quantity' => 75, 'description' => 'Balón de fútbol oficial tamaño 5 con tecnología Aerowtrac para vuelo estable, construcción de 12 paneles moldeados térmicamente'],
            ['name' => 'Mancuernas Set 20kg Ajustables', 'price' => 899.00, 'stock_quantity' => 40, 'description' => 'Set de mancuernas ajustables con discos revestidos en goma antideslizante, barra cromada antioxidante y cierre de seguridad tipo tuerca'],
            ['name' => 'Colchoneta Yoga Premium 6mm', 'price' => 299.00, 'stock_quantity' => 85, 'description' => 'Mat de yoga antideslizante de 6mm con superficie texturizada, material NBR ecológico, bolso de transporte con correa ajustable'],
            ['name' => 'Cinta de Correr Profesional', 'price' => 11999.00, 'stock_quantity' => 8, 'description' => 'Cinta motorizada plegable con motor de 2.5HP, pantalla LCD multifunción, 12 programas preestablecidos, velocidad hasta 12 km/h, soporta 120kg'],
            ['name' => 'Pesas Rusas Kettlebell 12kg', 'price' => 699.00, 'stock_quantity' => 55, 'description' => 'Kettlebell de hierro fundido sólido con recubrimiento vinílico de alta calidad, mango texturizado antideslizante, base plana para mayor estabilidad'],
            ['name' => 'Raqueta de Tenis Wilson Pro Staff', 'price' => 1599.00, 'stock_quantity' => 28, 'description' => 'Raqueta de tenis profesional con marco de grafito carbono, patrón de encordado 16x19, grip antideslizante, peso 300g, incluye funda protectora'],
            ['name' => 'Botines Adidas Predator Accuracy', 'price' => 2399.00, 'stock_quantity' => 48, 'description' => 'Botines de fútbol con tecnología Strike Zone para mejor control del balón, tapones de TPU para césped natural, upper Primeknit ajustado'],
            ['name' => 'Guantes de Boxeo Everlast Pro Style', 'price' => 799.00, 'stock_quantity' => 62, 'description' => 'Guantes de boxeo 12oz con relleno de espuma de alta densidad, cierre de velcro ajustable, material sintético duradero, ventilación en palma'],
            ['name' => 'Banco Musculación Multifunción', 'price' => 4599.00, 'stock_quantity' => 18, 'description' => 'Banco ajustable con 7 posiciones de respaldo, soporte para barras con doble gancho de seguridad, extensiones de piernas y curl predicador, soporta 300kg'],
        ];

        // Productos de Juguetes y Bebés (10 productos) - Precios en MXN
        $juguetesProducts = [
            ['name' => 'LEGO Star Wars Millennium Falcon', 'price' => 1799.00, 'stock_quantity' => 25, 'description' => 'Set de construcción con 1351 piezas para edades 9+, incluye 7 minifiguras de personajes icónicos, detalles auténticos del Halcón Milenario'],
            ['name' => 'Carriola Infanti 3 en 1', 'price' => 5599.00, 'stock_quantity' => 12, 'description' => 'Sistema de viaje modular: carriola reversible, moisés para recién nacidos y silla para auto grupo 0+, estructura de aluminio plegable, capota extensible'],
            ['name' => 'Casa de Muñecas Barbie Dreamhouse', 'price' => 1099.00, 'stock_quantity' => 35, 'description' => 'Casa de muñecas de 3 pisos y 8 habitaciones con muebles y accesorios, elevador que funciona, alberca con tobogán, luces y sonidos interactivos'],
            ['name' => 'Hot Wheels Pista Mega Salto', 'price' => 699.00, 'stock_quantity' => 50, 'description' => 'Pista de autos con loop vertical, rampa de salto extremo, lanzador de alta velocidad y zona de aterrizaje, incluye 2 vehículos Hot Wheels'],
            ['name' => 'Pañales Pampers Premium Care', 'price' => 599.00, 'stock_quantity' => 120, 'description' => 'Paquete de 72 pañales desechables talla M (6-10kg) con tecnología absorbente de 12 horas, canales de aire, indicador de humedad, hipoalergénicos'],
            ['name' => 'Silla de Comer Chicco Polly Magic', 'price' => 2999.00, 'stock_quantity' => 22, 'description' => 'Silla alta reclinable con bandeja doble removible, 7 posiciones de altura, respaldo con 4 posiciones, ruedas giratorias, funda lavable a máquina'],
            ['name' => 'Juego de Mesa Monopoly Clásico', 'price' => 499.00, 'stock_quantity' => 68, 'description' => 'Juego clásico de propiedades para 2-8 jugadores, incluye tablero, fichas metálicas, tarjetas, dinero, casas y hoteles, versión en español'],
            ['name' => 'Peluche Osito Gigante 120cm', 'price' => 899.00, 'stock_quantity' => 30, 'description' => 'Peluche de oso de felpa suave y abrazable de 120cm de altura, relleno hipoalergénico de fibra siliconada, ideal para decoración y compañía'],
            ['name' => 'Biberones Dr. Browns Set 4 Piezas', 'price' => 399.00, 'stock_quantity' => 95, 'description' => 'Set de 4 biberones anticólicos de 240ml con sistema de ventilación interna que reduce gases, tetinas de silicón nivel 1, libre de BPA'],
            ['name' => 'Triciclo Fisher-Price Charm Plus', 'price' => 1599.00, 'stock_quantity' => 38, 'description' => 'Triciclo evolutivo 3 en 1 con barra de empuje para padres, respaldo reclinable, capota extensible con protección UV, arnés de seguridad de 3 puntos'],
        ];

        // Productos de Belleza y Cuidado Personal (10 productos) - Precios en MXN
        $bellezaProducts = [
            ['name' => 'Perfume Carolina Herrera Good Girl', 'price' => 2999.00, 'stock_quantity' => 40, 'description' => 'Eau de Parfum 80ml con notas de jazmín sambac, almendra y café tostado, frasco icónico en forma de tacón alto, fragancia oriental floral'],
            ['name' => 'Set Maquillaje MAC Professional', 'price' => 3999.00, 'stock_quantity' => 22, 'description' => 'Kit profesional completo con paleta de 12 sombras, 3 labiales mate, iluminador, rubor, delineador de ojos y set de 5 brochas sintéticas'],
            ['name' => 'Secador de Pelo Philips 2200W', 'price' => 799.00, 'stock_quantity' => 50, 'description' => 'Secador profesional con tecnología iónica ThermoProtect, 6 combinaciones de velocidad/temperatura, concentrador de aire de 9mm, cable de 1.8m'],
            ['name' => 'Crema Facial La Roche-Posay Hyalu B5', 'price' => 699.00, 'stock_quantity' => 75, 'description' => 'Crema hidratante anti-edad con ácido hialurónico puro, vitamina B5, protección SPF 30, textura ligera de rápida absorción, 50ml'],
            ['name' => 'Shampoo Pantene Pro-V Restauración', 'price' => 179.00, 'stock_quantity' => 150, 'description' => 'Shampoo reparador 400ml para cabello dañado con Pro-Vitamina B5, antioxidantes y lípidos protectores, restaura el cabello desde la raíz'],
            ['name' => 'Plancha de Pelo BaByliss PRO Nano Titanium', 'price' => 1799.00, 'stock_quantity' => 35, 'description' => 'Plancha profesional con placas de titanio nano de 1.5", control de temperatura 150-230°C, calentamiento rápido en 30 segundos, cable giratorio'],
            ['name' => 'Kit Cuidado de Uñas Revlon', 'price' => 499.00, 'stock_quantity' => 82, 'description' => 'Set completo de manicura con 3 esmaltes ColorStay, base coat, top coat, removedor de cutículas, lima y cortauñas profesional'],
            ['name' => 'Cepillo Eléctrico Oral-B Pro 1000', 'price' => 1099.00, 'stock_quantity' => 60, 'description' => 'Cepillo de dientes eléctrico recargable con sensor de presión 3D, tecnología de limpieza profunda, temporizador de 2 minutos, incluye 1 cabezal'],
            ['name' => 'Mascarilla Facial Garnier SkinActive', 'price' => 99.00, 'stock_quantity' => 200, 'description' => 'Mascarilla purificante en hoja con carbón activado y ácido hialurónico, destapa poros, hidrata y refresca, uso único de 15 minutos'],
            ['name' => 'Depiladora Láser Philips Lumea Prestige', 'price' => 7999.00, 'stock_quantity' => 15, 'description' => 'Depiladora de luz pulsada IPL con sensor SmartSkin que detecta tono de piel, 4 accesorios especializados, 250,000 pulsos, hasta 92% menos vello'],
        ];

        // Productos de Herramientas (10 productos) - Precios en MXN
        $herramientasProducts = [
            ['name' => 'Taladro Inalámbrico Bosch 20V Max', 'price' => 1799.00, 'stock_quantity' => 30, 'description' => 'Taladro percutor inalámbrico con batería de litio 2.0Ah, 13mm de portabrocas, 2 velocidades, luz LED, maletín rígido y cargador incluido'],
            ['name' => 'Juego de Llaves Combinadas 12 Piezas', 'price' => 499.00, 'stock_quantity' => 60, 'description' => 'Set de llaves combinadas métricas cromadas de 8mm a 19mm, acabado espejo, acero cromo-vanadio forjado, estuche organizador enrollable'],
            ['name' => 'Sierra Circular Eléctrica 1400W', 'price' => 1299.00, 'stock_quantity' => 25, 'description' => 'Sierra circular con motor de 1400W, guía láser integrada, profundidad de corte ajustable hasta 65mm, disco de 185mm, base de aluminio fundido'],
            ['name' => 'Kit de Herramientas Mecánico 120 Piezas', 'price' => 899.00, 'stock_quantity' => 45, 'description' => 'Maletín profesional con dados, llaves, destornilladores, alicates y herramientas especializadas para mecánica automotriz, acero cromo-vanadio'],
            ['name' => 'Amoladora Angular DeWalt 900W', 'price' => 1599.00, 'stock_quantity' => 32, 'description' => 'Esmeriladora angular de 4.5" (115mm) con motor de 900W, empuñadura lateral ajustable, protector sin herramientas, 11,000 RPM'],
            ['name' => 'Nivel Láser Stanley Cross90', 'price' => 1199.00, 'stock_quantity' => 38, 'description' => 'Nivel láser de líneas cruzadas autonivelante con rango de 15m, precisión ±3mm, soporte magnético incluido, funciona con baterías AA'],
            ['name' => 'Soldadora Inverter 200A Profesional', 'price' => 2399.00, 'stock_quantity' => 18, 'description' => 'Soldadora eléctrica inverter portátil con display digital LCD, corriente regulable 20-200A, incluye careta, pinzas y electrodos, tecnología IGBT'],
            ['name' => 'Compresor de Aire 50L 2HP', 'price' => 2999.00, 'stock_quantity' => 12, 'description' => 'Compresor de aire con motor de 2HP, tanque de 50 litros, presión máxima 115 PSI, manómetros duales, kit de 5 accesorios neumáticos'],
            ['name' => 'Escalera Telescópica de Aluminio', 'price' => 1799.00, 'stock_quantity' => 22, 'description' => 'Escalera extensible multiposición hasta 3.8m, aleación de aluminio ligero, carga máxima 150kg, sistema de bloqueo de seguridad, pies antideslizantes'],
            ['name' => 'Pistola de Calor Black+Decker 1800W', 'price' => 699.00, 'stock_quantity' => 48, 'description' => 'Pistola de aire caliente industrial con motor de 1800W, 2 niveles de temperatura (400°C y 600°C), boquilla concentradora y difusora incluidas'],
        ];

        // Productos de Libros y Entretenimiento (10 productos) - Precios en MXN
        $librosProducts = [
            ['name' => 'Cien Años de Soledad - García Márquez', 'price' => 259.00, 'stock_quantity' => 100, 'description' => 'Edición de bolsillo del clásico de literatura latinoamericana, obra maestra del realismo mágico, 496 páginas, editorial Debolsillo'],
            ['name' => 'PlayStation 5 Digital Edition', 'price' => 11999.00, 'stock_quantity' => 8, 'description' => 'Consola de videojuegos de nueva generación con SSD ultra rápido de 825GB, Ray Tracing, resolución 4K hasta 120fps, DualSense incluido'],
            ['name' => 'Guitarra Acústica Fender FA-125', 'price' => 3199.00, 'stock_quantity' => 18, 'description' => 'Guitarra acústica dreadnought de cuerdas de acero, tapa de pícea laminada, diapasón de nogal, sonido brillante, incluye funda acolchada'],
            ['name' => 'Harry Potter Colección Completa', 'price' => 999.00, 'stock_quantity' => 65, 'description' => 'Box set con los 7 libros de la saga en tapa dura, edición especial ilustrada con arte original, incluye mapa del merodeador como regalo'],
            ['name' => 'Nintendo Switch OLED', 'price' => 7999.00, 'stock_quantity' => 15, 'description' => 'Consola híbrida con pantalla OLED de 7", 64GB almacenamiento interno, audio mejorado, base con puerto LAN, Joy-Con incluidos, dock HDMI'],
            ['name' => 'El Principito - Antoine de Saint-Exupéry', 'price' => 179.00, 'stock_quantity' => 150, 'description' => 'Edición ilustrada del clásico infantil con acuarelas originales del autor, traducción de Bonifacio del Carril, 96 páginas, tapa dura'],
            ['name' => 'Vinilo The Beatles Abbey Road', 'price' => 699.00, 'stock_quantity' => 42, 'description' => 'Vinilo LP remasterizado del icónico álbum de 1969, 180g de peso, incluye póster desplegable, sonido estéreo de alta fidelidad'],
            ['name' => 'Juego FIFA 24 PS5', 'price' => 1599.00, 'stock_quantity' => 50, 'description' => 'Simulador de fútbol con tecnología HyperMotionV, más de 700 equipos con licencias oficiales, modo carrera mejorado, Ultimate Team y VOLTA Football'],
            ['name' => 'Audífonos Inalámbricos JBL Tune 510BT', 'price' => 1199.00, 'stock_quantity' => 70, 'description' => 'Auriculares Bluetooth over-ear con sonido Pure Bass, hasta 40 horas de batería, carga rápida, micrófono integrado, plegables y portátiles'],
            ['name' => '1984 - George Orwell', 'price' => 219.00, 'stock_quantity' => 88, 'description' => 'Novela distópica clásica en edición de bolsillo, traducción de Miguel Temprano García, 352 páginas, editorial Debolsillo, incluye prólogo'],
        ];

        // Productos de Automotriz (10 productos) - Precios en MXN
        $automotrizProducts = [
            ['name' => 'Llanta Pirelli P4 185/65 R15', 'price' => 1099.00, 'stock_quantity' => 80, 'description' => 'Neumático para auto con compuesto de sílice para mejor tracción en mojado, diseño de banda de rodadura optimizado, construcción radial'],
            ['name' => 'Batería LTH L-42-500 12V 75Ah', 'price' => 1799.00, 'stock_quantity' => 35, 'description' => 'Batería libre de mantenimiento con tecnología de calcio-plata, 500 amperes de arranque en frío, 24 meses de garantía, compatible con la mayoría de vehículos'],
            ['name' => 'Limpia Parabrisas Bosch AeroTwin', 'price' => 379.00, 'stock_quantity' => 110, 'description' => 'Par de escobillas limpiaparabrisas premium con tecnología aerodinámica sin armazón, adaptador universal incluido, duración extendida'],
            ['name' => 'Aceite Castrol Edge 5W-30 4L', 'price' => 499.00, 'stock_quantity' => 120, 'description' => 'Aceite sintético para motor con tecnología Fluid Titanium, protección contra el desgaste, mejora la eficiencia del combustible, cumple normas API SN'],
            ['name' => 'Aspiradora Auto Black+Decker 12V', 'price' => 699.00, 'stock_quantity' => 65, 'description' => 'Aspiradora portátil para auto con conexión a encendedor de 12V, accesorios para tapicería y ranuras, filtro lavable, cable de 5m, bolsa recolectora'],
            ['name' => 'Cargador de Batería Inteligente 6A', 'price' => 599.00, 'stock_quantity' => 48, 'description' => 'Cargador automático de baterías con microcontrolador, corriente de 6A, protección contra sobrecarga y cortocircuito, para baterías 6V/12V'],
            ['name' => 'Funda Cubre Asientos Universal', 'price' => 399.00, 'stock_quantity' => 95, 'description' => 'Set completo de fundas de poliéster resistente para 5 asientos: 2 delanteros y banco trasero, diseño universal, fácil instalación, lavables'],
            ['name' => 'Cámara de Retroceso con Pantalla 4.3"', 'price' => 999.00, 'stock_quantity' => 38, 'description' => 'Sistema de visión trasera con monitor LCD a color de 4.3", cámara gran angular 170°, visión nocturna infrarroja, guías de estacionamiento'],
            ['name' => 'Compresor de Aire Portátil 12V', 'price' => 799.00, 'stock_quantity' => 52, 'description' => 'Inflador de neumáticos digital portátil, conexión a encendedor 12V, manómetro digital LCD, presión máxima 150 PSI, incluye adaptadores múltiples'],
            ['name' => 'Pastillas de Freno Bosch Cerámicas', 'price' => 599.00, 'stock_quantity' => 72, 'description' => 'Juego de pastillas de freno cerámicas para eje delantero, baja emisión de polvo, bajo nivel de ruido, frenado suave y seguro, incluye sensores'],
        ];

        // Productos de Jardín y Exterior (10 productos) - Precios en MXN
        $jardinProducts = [
            ['name' => 'Cortacésped Eléctrico 1400W', 'price' => 3599.00, 'stock_quantity' => 18, 'description' => 'Cortadora de césped con motor eléctrico de 1400W, bolsa recolectora de 35L, ancho de corte 35cm, 5 niveles de altura ajustable, asa plegable'],
            ['name' => 'Set de Herramientas de Jardín 5 Piezas', 'price' => 499.00, 'stock_quantity' => 55, 'description' => 'Kit profesional con pala jardinera, rastrillo de mano, tijera de podar, transplantador y cepillo de limpieza, mangos ergonómicos antideslizantes'],
            ['name' => 'Manguera Extensible 30m con Pistola', 'price' => 299.00, 'stock_quantity' => 85, 'description' => 'Manguera de riego flexible que se expande hasta 30m, pistola multifunción con 7 patrones de rociado, conectores rápidos, material látex reforzado'],
            ['name' => 'Sombrilla de Jardín 3m Octogonal', 'price' => 1799.00, 'stock_quantity' => 25, 'description' => 'Parasol octogonal de 3 metros con manivela de apertura y cierre, protección UV 50+, estructura de aluminio, tela poliéster impermeable'],
            ['name' => 'Macetas de Fibrocemento Set 3 Piezas', 'price' => 699.00, 'stock_quantity' => 42, 'description' => 'Set de 3 macetas decorativas en tamaños graduados (grande, mediano, chico), material fibrocemento resistente a intemperie, drenaje inferior'],
            ['name' => 'Bordeadora Eléctrica 450W', 'price' => 1199.00, 'stock_quantity' => 32, 'description' => 'Recortadora de bordes con motor de 450W, cabezal giratorio de 90°, ancho de corte 25cm, protector de seguridad, carrete de hilo automático'],
            ['name' => 'Sistema de Riego Automático por Goteo', 'price' => 1599.00, 'stock_quantity' => 28, 'description' => 'Kit de riego por goteo con temporizador digital programable, 20m de manguera, 20 goteros ajustables, conectores y estacas, para hasta 20 plantas'],
            ['name' => 'Parrilla Weber a Carbón 57cm', 'price' => 2599.00, 'stock_quantity' => 20, 'description' => 'Parrilla tipo kettle redonda de 57cm con tapa esmaltada, termómetro integrado, rejilla de cocción cromada, cenicero extraíble, ruedas resistentes'],
            ['name' => 'Luces Solares de Jardín Pack 8', 'price' => 399.00, 'stock_quantity' => 70, 'description' => 'Set de 8 estacas LED solares para jardín con panel solar individual, sensor de luz automático, resistentes al agua IP65, luz blanca cálida'],
            ['name' => 'Compostadora 300L Ecológica', 'price' => 899.00, 'stock_quantity' => 15, 'description' => 'Compostera de plástico reciclado de 300 litros, sistema de ventilación optimizado, compuertas de acceso superior y lateral, tapa con bisagras'],
        ];

        // Productos de Alimentos y Bebidas (10 productos) - Precios en MXN
        $alimentosProducts = [
            ['name' => 'Café Chiapas Orgánico 1kg', 'price' => 259.00, 'stock_quantity' => 120, 'description' => 'Café molido premium de origen Chiapas, tueste medio ideal para espresso y cafetera, certificación orgánica, notas de chocolate y nuez'],
            ['name' => 'Aceite de Oliva Extra Virgen 750ml', 'price' => 499.00, 'stock_quantity' => 85, 'description' => 'Aceite de oliva extra virgen primera presión en frío, origen mediterráneo, acidez menor a 0.5%, ideal para ensaladas y cocina saludable'],
            ['name' => 'Cajeta Coronado 450g', 'price' => 179.00, 'stock_quantity' => 150, 'description' => 'Cajeta tradicional mexicana de leche de cabra con textura cremosa, sabor caramelizado auténtico, preparación artesanal de Celaya'],
            ['name' => 'Tequila José Cuervo Especial Reposado', 'price' => 699.00, 'stock_quantity' => 60, 'description' => 'Tequila reposado 100% agave azul 750ml, añejado en barricas de roble blanco, notas suaves de vainilla, ideal para coctelería premium'],
            ['name' => 'Chocolate Turin 70% Cacao', 'price' => 139.00, 'stock_quantity' => 200, 'description' => 'Tableta de chocolate amargo mexicano 100g con 70% cacao, notas intensas y amargas, cacao de origen Tabasco, sin gluten'],
            ['name' => 'Miel Multifloral Orgánica 500g', 'price' => 299.00, 'stock_quantity' => 95, 'description' => 'Miel de flores silvestres orgánica de Yucatán, sin pasteurizar ni aditivos, producción sustentable, cristalización natural'],
            ['name' => 'Té de Jamaica Premium', 'price' => 119.00, 'stock_quantity' => 180, 'description' => 'Té de flor de jamaica en saquitos filtrantes, rico en antioxidantes, 25 sobres individuales, sabor natural sin azúcar, producto mexicano'],
            ['name' => 'Mermelada Artesanal de Fresa 400g', 'price' => 199.00, 'stock_quantity' => 110, 'description' => 'Mermelada casera de fresa de Irapuato con 60% de fruta natural, sin conservadores artificiales, endulzada con azúcar de caña'],
            ['name' => 'Chiles Jalapeños en Escabeche 500g', 'price' => 159.00, 'stock_quantity' => 140, 'description' => 'Chiles jalapeños en rodajas con zanahorias y especias en escabeche, sabor tradicional mexicano, frasco de vidrio, listo para consumir'],
            ['name' => 'Salsa Valentina 370ml', 'price' => 99.00, 'stock_quantity' => 250, 'description' => 'Salsa picante mexicana tradicional con chiles y especias, sabor equilibrado con toque de limón, etiqueta negra extra picante'],
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

                Product::create([
                    'name' => $productData['name'],
                    'slug' => $slug,
                    'description' => $productData['description'],
                    'short_description' => substr($productData['description'], 0, 150),
                    'sku' => $sku,
                    'price' => round($price, 2),
                    'stock_quantity' => $productData['stock_quantity'],
                    'category_id' => $category->id,
                    'user_id' => $users->random()->id,
                    'images' => json_encode(['images/placeholder-product.svg']),
                    'is_active' => true,
                    'is_featured' => rand(1, 100) <= 20, // 20% de productos destacados
                ]);
            }
        }
    }
}

