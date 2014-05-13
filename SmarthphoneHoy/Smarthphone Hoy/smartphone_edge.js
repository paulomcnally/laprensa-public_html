/**
 * Adobe Edge: symbol definitions
 */
(function($, Edge, compId){
//images folder
var im='images/';

var fonts = {};    fonts['source-sans-pro, sans-serif']='<script src=\"http://use.edgefonts.net/source-sans-pro:n4,n9,n7,i7,i4,n3,i3,n6,i6,i9,n2,i2:all.js\"></script>';

var opts = {
    'preloadAudio': false
};
var resources = [
];
var symbols = {
"stage": {
    version: "3.0.0",
    minimumCompatibleVersion: "3.0.0",
    build: "3.0.0.322",
    baseState: "Base State",
    scaleToFit: "none",
    centerStage: "none",
    initialState: "Base State",
    gpuAccelerate: false,
    resizeInstances: false,
    content: {
            dom: [
            {
                id: 'title',
                type: 'text',
                rect: ['221px', '13px','auto','auto','auto', 'auto'],
                text: "Llegó el momento de un",
                align: "left",
                font: ['Verdana, Geneva, sans-serif', 25, "rgba(255,255,255,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text2',
                type: 'text',
                rect: ['292px', '110px','440px','auto','auto', 'auto'],
                text: "SMARTPHONE",
                align: "left",
                font: ['Lucida Console, Monaco, monospace', 66, "rgba(255,255,255,1)", "100", "none", "normal"],
                filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(0,0,0,0.58)", 1, 1, 0],
                transform: [[],[],[],['0.9896','1.44581']]
            },
            {
                id: 'RoundRect3Copy13',
                type: 'rect',
                rect: ['72px', '355px','148px','64px','auto', 'auto'],
                clip: ['rect(0px 137.9140625px 64px 0px)'],
                borderRadius: ["10px", "10px", "10px", "10px"],
                fill: ["rgba(192,192,192,1)",[270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                stroke: [0,"rgba(0,0,0,1)","none"],
                transform: [[],[],[],['1.92446','1.57822']]
            },
            {
                id: 'RoundRect3Copy12',
                type: 'rect',
                rect: ['72px', '469px','148px','64px','auto', 'auto'],
                clip: ['rect(0px 137.9140625px 64px 0px)'],
                borderRadius: ["10px", "10px", "10px", "10px"],
                fill: ["rgba(192,192,192,1)",[270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                stroke: [0,"rgba(0,0,0,1)","none"],
                transform: [[],[],[],['1.92446','1.57822']]
            },
            {
                id: 'RoundRect3Copy11',
                type: 'rect',
                rect: ['72px', '581px','148px','64px','auto', 'auto'],
                clip: ['rect(0px 137.9140625px 64px 0px)'],
                borderRadius: ["10px", "10px", "10px", "10px"],
                fill: ["rgba(192,192,192,1)",[270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                stroke: [0,"rgba(0,0,0,1)","none"],
                transform: [[],[],[],['1.92446','1.57822']]
            },
            {
                id: 'Text4',
                type: 'text',
                rect: ['191px', '287px','119px','28px','auto', 'auto'],
                text: "AIRIS TM485",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 18, "rgba(255,255,255,1)", "100", "none", "normal"]
            },
            {
                id: 'Text4Copy',
                type: 'text',
                rect: ['429px', '301px','119px','28px','auto', 'auto'],
                text: "AIRIS TM420",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 18, "rgba(255,255,255,1)", "100", "none", "normal"],
                filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(0,0,0,0.54)", 1, 1, 0]
            },
            {
                id: 'smartphone1',
                type: 'image',
                rect: ['265px', '302px','208px','397px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"smartphone1.png",'0px','0px']
            },
            {
                id: 'smarthphone2',
                type: 'image',
                rect: ['496px', '852px','202px','394px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"smarthphone2.png",'0px','0px']
            },
            {
                id: 'logogallo',
                type: 'image',
                rect: ['12px', '1453px','130px','81px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"logogallo.png",'0px','0px']
            },
            {
                id: 'Text13',
                type: 'text',
                rect: ['794px', '66px','auto','auto','auto', 'auto'],
                text: "ver video",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 11, "rgba(255,255,255,1.00)", "100", "none", "normal"]
            },
            {
                id: 'camara2',
                type: 'rect',
                rect: ['591', '185','auto','auto','auto', 'auto'],
                cursor: ['pointer']
            },
            {
                id: 'Text',
                type: 'text',
                rect: ['104px', '348px','auto','auto','auto', 'auto'],
                text: "CONTADO",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 11, "rgba(255,255,255,1)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text3Copy',
                type: 'text',
                rect: ['196px', '364px','78px','auto','auto', 'auto'],
                text: "A tan solo",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 10, "rgba(255,220,0,1.00)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text7',
                type: 'text',
                rect: ['32px', '392px','auto','auto','auto', 'auto'],
                text: "C$5,799",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 15, "rgba(255,255,255,1.00)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text7Copy',
                type: 'text',
                rect: ['168px', '379px','auto','auto','auto', 'auto'],
                text: "C$3,799",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 15, "rgba(255,233,0,1.00)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text7Copy2',
                type: 'text',
                rect: ['164px', '405px','auto','auto','auto', 'auto'],
                text: "IVA INCLUIDO",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 11, "rgba(255,233,0,1.00)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Rectangle2',
                type: 'rect',
                rect: ['29px', '408px','68px','1px','auto', 'auto'],
                opacity: 0.36839978448276,
                fill: ["rgba(108,42,42,1.00)"],
                stroke: [0,"rgb(0, 0, 0)","none"],
                transform: [[],['32'],[],['0.90436','-7.91219']]
            },
            {
                id: 'Rectangle2Copy',
                type: 'rect',
                rect: ['33px', '408px','68px','1px','auto', 'auto'],
                opacity: 0.36839978448276,
                fill: ["rgba(108,42,42,1.00)"],
                stroke: [0,"rgb(0, 0, 0)","none"],
                transform: [[],['-43'],[],['0.90436','-7.91219']]
            },
            {
                id: 'RoundRect3Copy8',
                type: 'rect',
                rect: ['744px', '908px','148px','64px','auto', 'auto'],
                clip: ['rect(0px 137.9140625px 64px 0px)'],
                borderRadius: ["10px", "10px", "10px", "10px"],
                fill: ["rgba(192,192,192,1)",[270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                stroke: [0,"rgba(0,0,0,1)","none"],
                transform: [[],['-180'],[],['1.92446','1.57822']]
            },
            {
                id: 'RoundRect3Copy9',
                type: 'rect',
                rect: ['744px', '1022px','148px','64px','auto', 'auto'],
                clip: ['rect(0px 137.9140625px 64px 0px)'],
                borderRadius: ["10px", "10px", "10px", "10px"],
                fill: ["rgba(192,192,192,1)",[270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                stroke: [0,"rgba(0,0,0,1)","none"],
                transform: [[],['-180'],[],['1.92446','1.57822']]
            },
            {
                id: 'RoundRect3Copy10',
                type: 'rect',
                rect: ['744px', '1134px','148px','64px','auto', 'auto'],
                clip: ['rect(0px 137.9140625px 64px 0px)'],
                borderRadius: ["10px", "10px", "10px", "10px"],
                fill: ["rgba(192,192,192,1)",[270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                stroke: [0,"rgba(0,0,0,1)","none"],
                transform: [[],['-180'],[],['1.92446','1.57822']]
            },
            {
                id: 'TextCopy',
                type: 'text',
                rect: ['72px', '480px','auto','auto','auto', 'auto'],
                text: "CRÉDITO",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 11, "rgba(255,255,255,1)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text3Copy2',
                type: 'text',
                rect: ['171px', '506px','62px','auto','auto', 'auto'],
                text: "(cuotas<br>quincenales)",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 9, "rgba(255,255,255,1.00)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text7Copy5',
                type: 'text',
                rect: ['63px', '515px','auto','auto','auto', 'auto'],
                text: "SIN PRIMA",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 12, "rgba(255,255,255,1.00)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text7Copy4',
                type: 'text',
                rect: ['160px', '475px','auto','auto','auto', 'auto'],
                text: "C$207",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 15, "rgba(255,233,0,1.00)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'TextCopy2',
                type: 'text',
                rect: ['86px', '578px','auto','auto','auto', 'auto'],
                text: "AGREGUE SU <br>ACCESORIO OPCIONAL",
                align: "center",
                font: ['Arial, Helvetica, sans-serif', 11, "rgba(255,255,255,1)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text3Copy4',
                type: 'text',
                rect: ['36px', '620px','78px','auto','auto', 'auto'],
                text: "PROTECTOR <br>DE CELULAR:",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 9, "rgba(255,255,255,1)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text7Copy7',
                type: 'text',
                rect: ['115px', '619px','54px','auto','auto', 'auto'],
                text: "C$249",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 15, "rgba(255,233,0,1.00)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text3',
                type: 'text',
                rect: ['37px', '369px','78px','auto','auto', 'auto'],
                text: "Precio regular",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 12, "rgba(255,255,255,1)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text3Copy5',
                type: 'text',
                rect: ['215px', '641px','78px','auto','auto', 'auto'],
                text: "Crédito",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 10, "rgba(255,230,0,1.00)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text7Copy9',
                type: 'text',
                rect: ['203px', '613px','auto','auto','auto', 'auto'],
                text: "C$13",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 15, "rgba(255,233,0,1.00)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text7Copy10',
                type: 'text',
                rect: ['34px', '681px','auto','auto','auto', 'auto'],
                text: "+ 28 CUPONES",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 25, "rgba(5,61,248,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text7Copy11',
                type: 'text',
                rect: ['732px', '1225px','auto','auto','auto', 'auto'],
                text: "+ 28 CUPONES",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 25, "rgba(0,59,255,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text14Copy2',
                type: 'text',
                rect: ['30px', '917px','448px','258px','auto', 'auto'],
                text: "-Cámara trasera 3 Mpx i con flash LED, -Cámara frontal -Wifi - Lector MicroSD hasta 32 GB - Radio FM -  CPU MTK6572 Dual Core 1 GHz - Bluetooth 4.0 - Memoria 512 MB - GPS - Almacenamiento 4GB - Pantalla Multi-táctil capacitiva de 4¨ ",
                align: "justify",
                font: ['Verdana, Geneva, sans-serif', 22, "rgba(255,255,255,1.00)", "100", "none", "normal"],
                filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(4,4,4,1.00)", 2, 2, 0]
            },
            {
                id: 'RectangleCopy4',
                type: 'rect',
                rect: ['351px', '1279px','236px','51px','auto', 'auto'],
                fill: ["rgba(40,125,125,1)",[180,[['rgba(191,191,191,1.00)',0],['rgba(255,255,255,1.00)',100]]]],
                stroke: [0,"rgb(0, 0, 0)","none"],
                filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(0,0,0,0.46)", 0, 3, 2],
                transform: [[],[],[],['1.19615','1.19615']]
            },
            {
                id: 'Rectangle',
                type: 'rect',
                rect: ['570px', '1372px','295px','46px','auto', 'auto'],
                fill: ["rgba(40,125,125,1)",[180,[['rgba(191,191,191,1.00)',0],['rgba(255,255,255,1.00)',100]]]],
                stroke: [0,"rgb(0, 0, 0)","none"],
                filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(0,0,0,0.46)", 0, 3, 2]
            },
            {
                id: 'Text11',
                type: 'text',
                rect: ['587px', '1389px','auto','auto','auto', 'auto'],
                text: "CONSULTE",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 16, "rgba(12,22,174,1)", "100", "none", "normal"]
            },
            {
                id: 'Group',
                type: 'group',
                rect: ['696px', '1384px','42','30','auto', 'auto'],
                cursor: ['pointer'],
                c: [
                {
                    id: 'Ellipse',
                    type: 'ellipse',
                    rect: ['0px', '0px','42px','30px','auto', 'auto'],
                    borderRadius: ["50%", "50%", "50%", "50%"],
                    fill: ["rgba(24,57,202,0.65)"],
                    stroke: [0,"rgb(0, 0, 0)","none"]
                },
                {
                    id: 'Text12',
                    type: 'text',
                    rect: ['4px', '5px','auto','auto','auto', 'auto'],
                    text: "AQUÍ",
                    align: "left",
                    font: ['Arial, Helvetica, sans-serif', 16, "rgba(255,255,255,1.00)", "100", "none", "normal"]
                }]
            },
            {
                id: 'Text17',
                type: 'text',
                rect: ['749px', '1387px','auto','auto','auto', 'auto'],
                text: "su inscripción",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 16, "rgba(13,28,233,1.00)", "100", "none", "normal"]
            },
            {
                id: 'RectangleCopy2',
                type: 'rect',
                rect: ['101px', '1372px','295px','46px','auto', 'auto'],
                fill: ["rgba(40,125,125,1)",[180,[['rgba(191,191,191,1.00)',0],['rgba(255,255,255,1.00)',100]]]],
                stroke: [0,"rgb(0, 0, 0)","none"],
                filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(0,0,0,0.46)", 0, 3, 2]
            },
            {
                id: 'manitoCopy2',
                type: 'image',
                rect: ['483px', '1320px','36px','30px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"manito.svg",'0px','0px'],
                transform: [[],[],[],['0.94444','0.94444']]
            },
            {
                id: 'manito',
                type: 'image',
                rect: ['744px', '1403px','36px','30px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"manito.svg",'0px','0px']
            },
            {
                id: 'Text11Copy',
                type: 'text',
                rect: ['133px', '1384px','auto','auto','auto', 'auto'],
                text: "BASES DE LA PROMOCIÓN",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 16, "rgba(12,22,174,1)", "100", "none", "normal"]
            },
            {
                id: 'manitoCopy',
                type: 'image',
                rect: ['310px', '1408px','36px','30px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"manito.svg",'0px','0px']
            },
            {
                id: 'Text11Copy2',
                type: 'text',
                rect: ['380px', '1292px','auto','auto','auto', 'auto'],
                text: "RESERVE AQUÍ",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 20, "rgba(12,22,174,1)", "100", "none", "normal"],
                transform: [[],[],[],['1.19615','1.19615']]
            },
            {
                id: 'Text14',
                type: 'text',
                rect: ['560px', '302px','398px','248px','auto', 'auto'],
                text: "-Cámara trasera 8 Mpx i con flash LED, -Cámara frontal -Wifi - Lector MicroSD hasta 32 GB -Radio FM -  CPU MTK6572 Dual Core 1.3 GHz - Bluetooth 4.0 - Memoria 512 MB - GPS -Almacenamiento 4GB - Pantalla Multi-táctil capacitiva de 4¨ IPS (visión de alto rendimiento)",
                align: "justify",
                font: ['Verdana, Geneva, sans-serif', 22, "rgba(255,255,255,1.00)", "100", "none", "normal"],
                filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(0,0,0,1.00)", 2, 2, 0]
            },
            {
                id: 'TextCopy9',
                type: 'text',
                rect: ['781px', '904px','auto','auto','auto', 'auto'],
                text: "CONTADO",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 11, "rgba(255,255,255,1)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text3Copy9',
                type: 'text',
                rect: ['726px', '931px','78px','auto','auto', 'auto'],
                text: "Precio regular",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 10, "rgba(255,255,255,1)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text3Copy8',
                type: 'text',
                rect: ['873px', '916px','78px','auto','auto', 'auto'],
                text: "A tan solo",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 10, "rgba(255,220,0,1.00)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text7Copy15',
                type: 'text',
                rect: ['714px', '953px','auto','auto','auto', 'auto'],
                text: "C$4,199",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 15, "rgba(255,255,255,1.00)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text7Copy14',
                type: 'text',
                rect: ['845px', '929px','auto','auto','auto', 'auto'],
                text: "C$2,799",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 15, "rgba(255,233,0,1.00)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text7Copy13',
                type: 'text',
                rect: ['841px', '953px','auto','auto','auto', 'auto'],
                text: "IVA INCLUIDO",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 11, "rgba(255,233,0,1.00)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Rectangle2Copy3',
                type: 'rect',
                rect: ['714px', '963px','68px','1px','auto', 'auto'],
                opacity: 0.36839978448276,
                fill: ["rgba(108,42,42,1.00)"],
                stroke: [0,"rgb(0, 0, 0)","none"],
                transform: [[],['25'],[],['0.90436','-7.91219']]
            },
            {
                id: 'Rectangle2Copy2',
                type: 'rect',
                rect: ['714px', '963px','68px','1px','auto', 'auto'],
                opacity: 0.36839978448276,
                fill: ["rgba(108,42,42,1.00)"],
                stroke: [0,"rgb(0, 0, 0)","none"],
                transform: [[],['-50'],[],['0.90436','-7.91219']]
            },
            {
                id: 'RoundRect',
                type: 'rect',
                rect: ['655px', '585px','335px','190px','auto', 'auto'],
                borderRadius: ["10px", "10px", "10px", "10px"],
                fill: ["rgba(255,255,255,0.51)"],
                stroke: [0,"rgb(0, 0, 0)","none"]
            },
            {
                id: 'TextCopy8',
                type: 'text',
                rect: ['717px', '1025px','auto','auto','auto', 'auto'],
                text: "CRÉDITO",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 11, "rgba(255,255,255,1)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text3Copy7',
                type: 'text',
                rect: ['879px', '1072px','58px','auto','auto', 'auto'],
                text: "(cuotas<br>quincenales)",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 9, "rgba(255,255,255,1.00)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text7Copy12',
                type: 'text',
                rect: ['717px', '1051px','auto','auto','auto', 'auto'],
                text: "SIN PRIMA",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 12, "rgba(255,255,255,1.00)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text7Copy8',
                type: 'text',
                rect: ['843px', '1035px','auto','auto','auto', 'auto'],
                text: "C$152",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 15, "rgba(255,233,0,1.00)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'TextCopy7',
                type: 'text',
                rect: ['763px', '1131px','auto','auto','auto', 'auto'],
                text: "AGREGUE SU <br>ACCESORIO OPCIONAL",
                align: "center",
                font: ['Arial, Helvetica, sans-serif', 11, "rgba(255,255,255,1)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text3Copy6',
                type: 'text',
                rect: ['719px', '1176px','78px','auto','auto', 'auto'],
                text: "PROTECTOR <br>DE CELULAR:",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 9, "rgba(255,255,255,1)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text7Copy6',
                type: 'text',
                rect: ['806px', '1176px','auto','auto','auto', 'auto'],
                text: "C$249",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 15, "rgba(255,233,0,1.00)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text3Copy3',
                type: 'text',
                rect: ['906px', '1197px','78px','auto','auto', 'auto'],
                text: "Crédito",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 10, "rgba(255,230,0,1.00)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'Text7Copy3',
                type: 'text',
                rect: ['894px', '1169px','auto','auto','auto', 'auto'],
                text: "C$13",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 15, "rgba(255,233,0,1.00)", "100", "none", "normal"],
                transform: [[],[],[],['1.40665','1.40665']]
            },
            {
                id: 'delgado',
                type: 'image',
                rect: ['484px', '264px','59px','496px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"delgado.png",'0px','0px'],
                transform: [[],[],[],['0.59321','0.8004']]
            },
            {
                id: 'Text5',
                type: 'text',
                rect: ['427px', '724px','auto','auto','auto', 'auto'],
                text: "ULTRA DELGADO",
                align: "justify",
                font: ['Arial Black, Gadget, sans-serif', 22, "rgba(0,0,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text6',
                type: 'text',
                rect: ['478px', '706px','auto','auto','auto', 'auto'],
                text: "( 9 mm)",
                align: "justify",
                font: ['Verdana, Geneva, sans-serif', 18, "rgba(0,0,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'doblechip2',
                type: 'image',
                rect: ['676px', '616px','95px','129px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"doblechip.svg",'0px','0px']
            },
            {
                id: 'Text7Copy16',
                type: 'text',
                rect: ['819px', '609px','auto','auto','auto', 'auto'],
                text: "DOBLE",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 25, "rgba(5,61,248,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text7Copy17',
                type: 'text',
                rect: ['792px', '632px','auto','auto','auto', 'auto'],
                text: "CHIP",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 55, "rgba(5,61,248,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text8',
                type: 'text',
                rect: ['782px', '706px','auto','auto','auto', 'auto'],
                text: "DESBLOQUEADOS <br>DE FÁBRICA",
                align: "center",
                font: ['Arial, Helvetica, sans-serif', 20, "rgba(0,0,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'logohoy',
                type: 'image',
                rect: ['851px', '1453px','114px','75px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"logohoy.png",'0px','0px']
            }],
            symbolInstances: [
            {
                id: 'camara2',
                symbolName: 'camara',
                autoPlay: {

                }
            }
            ]
        },
    states: {
        "Base State": {
            "${_RoundRect3Copy13}": [
                ["style", "top", '355px'],
                ["transform", "scaleY", '1.57822'],
                ["transform", "rotateZ", '0deg'],
                ["transform", "scaleX", '1.92446'],
                ["gradient", "background-image", [270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                ["style", "left", '72px'],
                ["style", "clip", [0,137.9140625,64,0], {valueTemplate:'rect(@@0@@px @@1@@px @@2@@px @@3@@px)'} ]
            ],
            "${_Text3Copy}": [
                ["style", "top", '364px'],
                ["transform", "scaleY", '1.40665'],
                ["style", "width", '78px'],
                ["transform", "scaleX", '1.40665'],
                ["color", "color", 'rgba(255,220,0,1.00)'],
                ["style", "left", '196px'],
                ["style", "font-size", '10px']
            ],
            "${_Text2}": [
                ["subproperty", "filter.drop-shadow.color", 'rgba(0,0,0,0.58)'],
                ["transform", "scaleX", '0.9896'],
                ["style", "left", '292px'],
                ["style", "font-size", '66px'],
                ["style", "top", '110px'],
                ["transform", "scaleY", '1.44581'],
                ["style", "width", '440px'],
                ["style", "font-family", 'Lucida Console, Monaco, monospace'],
                ["subproperty", "filter.drop-shadow.offsetH", '1px'],
                ["subproperty", "filter.drop-shadow.offsetV", '1px']
            ],
            "${_Text3Copy7}": [
                ["style", "top", '1072px'],
                ["transform", "scaleY", '1.40665'],
                ["style", "width", '58px'],
                ["transform", "scaleX", '1.40665'],
                ["color", "color", 'rgba(255,255,255,1)'],
                ["style", "left", '879px'],
                ["style", "font-size", '9px']
            ],
            "${_RoundRect3Copy8}": [
                ["style", "top", '908px'],
                ["transform", "scaleY", '1.57822'],
                ["transform", "rotateZ", '-180deg'],
                ["transform", "scaleX", '1.92446'],
                ["gradient", "background-image", [270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                ["style", "left", '744px'],
                ["style", "clip", [0,137.9140625,64,0], {valueTemplate:'rect(@@0@@px @@1@@px @@2@@px @@3@@px)'} ]
            ],
            "${_Text11Copy}": [
                ["style", "top", '1384px'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '133px']
            ],
            "${_doblechip2}": [
                ["style", "left", '676px'],
                ["style", "top", '616px']
            ],
            "${_Text3Copy5}": [
                ["style", "top", '641px'],
                ["transform", "scaleY", '1.40665'],
                ["style", "width", '78px'],
                ["transform", "scaleX", '1.40665'],
                ["color", "color", 'rgba(255,230,0,1.00)'],
                ["style", "left", '215px'],
                ["style", "font-size", '10px']
            ],
            "${_logohoy}": [
                ["style", "left", '851px'],
                ["style", "top", '1453px']
            ],
            "${_Text7Copy13}": [
                ["style", "top", '953px'],
                ["transform", "scaleY", '1.40665'],
                ["transform", "scaleX", '1.40665'],
                ["color", "color", 'rgba(255,233,0,1)'],
                ["style", "font-family", 'Arial, Helvetica, sans-serif'],
                ["style", "left", '841px'],
                ["style", "font-size", '11px']
            ],
            "${_TextCopy8}": [
                ["transform", "scaleX", '1.40665'],
                ["style", "left", '717px'],
                ["transform", "scaleY", '1.40665'],
                ["style", "top", '1025px']
            ],
            "${_Text7Copy5}": [
                ["style", "top", '515px'],
                ["transform", "scaleY", '1.40665'],
                ["color", "color", 'rgba(255,255,255,1)'],
                ["transform", "scaleX", '1.40665'],
                ["style", "font-family", 'Arial, Helvetica, sans-serif'],
                ["style", "left", '63px'],
                ["style", "font-size", '12px']
            ],
            "${_TextCopy}": [
                ["style", "top", '480px'],
                ["transform", "scaleX", '1.40665'],
                ["transform", "scaleY", '1.40665'],
                ["style", "left", '72px']
            ],
            "${_Text3Copy8}": [
                ["style", "top", '916px'],
                ["transform", "scaleY", '1.40665'],
                ["style", "font-size", '10px'],
                ["transform", "scaleX", '1.40665'],
                ["color", "color", 'rgba(255,220,0,1)'],
                ["style", "left", '873px'],
                ["style", "width", '78px']
            ],
            "${_Text3Copy4}": [
                ["style", "top", '620px'],
                ["transform", "scaleY", '1.40665'],
                ["transform", "scaleX", '1.40665'],
                ["style", "width", '78px'],
                ["style", "left", '36px'],
                ["style", "font-size", '9px']
            ],
            "${_RoundRect3Copy9}": [
                ["style", "top", '1022px'],
                ["transform", "scaleY", '1.57822'],
                ["transform", "rotateZ", '-180deg'],
                ["transform", "scaleX", '1.92446'],
                ["gradient", "background-image", [270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                ["style", "left", '744px'],
                ["style", "clip", [0,137.9140625,64,0], {valueTemplate:'rect(@@0@@px @@1@@px @@2@@px @@3@@px)'} ]
            ],
            "${_Text7Copy7}": [
                ["style", "top", '619px'],
                ["style", "font-size", '15px'],
                ["transform", "scaleY", '1.40665'],
                ["color", "color", 'rgba(255,233,0,1)'],
                ["transform", "scaleX", '1.40665'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '115px'],
                ["style", "width", '54px']
            ],
            "${_Text7Copy16}": [
                ["style", "top", '609px'],
                ["color", "color", 'rgba(5,61,248,1)'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '819px'],
                ["style", "font-size", '25px']
            ],
            "${_Text7Copy3}": [
                ["style", "top", '1169px'],
                ["transform", "scaleY", '1.40665'],
                ["transform", "scaleX", '1.40665'],
                ["color", "color", 'rgba(255,233,0,1)'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '894px'],
                ["style", "font-size", '15px']
            ],
            "${_Text11Copy2}": [
                ["style", "top", '1292px'],
                ["transform", "scaleY", '1.19615'],
                ["transform", "scaleX", '1.19615'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '380px'],
                ["style", "font-size", '20px']
            ],
            "${_Text7Copy2}": [
                ["style", "top", '405px'],
                ["transform", "scaleY", '1.40665'],
                ["color", "color", 'rgba(255,233,0,1)'],
                ["transform", "scaleX", '1.40665'],
                ["style", "font-family", 'Arial, Helvetica, sans-serif'],
                ["style", "left", '164px'],
                ["style", "font-size", '11px']
            ],
            "${_manito}": [
                ["style", "left", '744px'],
                ["style", "top", '1403px']
            ],
            "${_Text3Copy2}": [
                ["style", "top", '506px'],
                ["transform", "scaleY", '1.40665'],
                ["style", "font-size", '9px'],
                ["transform", "scaleX", '1.40665'],
                ["color", "color", 'rgba(255,255,255,1.00)'],
                ["style", "left", '171px'],
                ["style", "width", '62px']
            ],
            "${_Rectangle2Copy}": [
                ["color", "background-color", 'rgba(108,42,42,1)'],
                ["style", "top", '408px'],
                ["transform", "scaleY", '-7.91219'],
                ["transform", "rotateZ", '-43deg'],
                ["transform", "scaleX", '0.90436'],
                ["style", "opacity", '0.36839979887008667'],
                ["style", "left", '33px'],
                ["style", "-webkit-transform-origin", [50,0], {valueTemplate:'@@0@@% @@1@@%'} ],
                ["style", "-moz-transform-origin", [50,0],{valueTemplate:'@@0@@% @@1@@%'}],
                ["style", "-ms-transform-origin", [50,0],{valueTemplate:'@@0@@% @@1@@%'}],
                ["style", "msTransformOrigin", [50,0],{valueTemplate:'@@0@@% @@1@@%'}],
                ["style", "-o-transform-origin", [50,0],{valueTemplate:'@@0@@% @@1@@%'}]
            ],
            "${_Text13}": [
                ["style", "top", '90px'],
                ["color", "color", 'rgba(255,255,255,1.00)'],
                ["style", "left", '836px'],
                ["style", "font-size", '18px']
            ],
            "${_Text6}": [
                ["style", "top", '706px'],
                ["color", "color", 'rgba(0,0,0,1.00)'],
                ["style", "left", '478px'],
                ["style", "font-size", '18px']
            ],
            "${_logogallo}": [
                ["style", "left", '12px'],
                ["style", "top", '1453px']
            ],
            "${_Text7Copy12}": [
                ["style", "top", '1051px'],
                ["transform", "scaleY", '1.40665'],
                ["transform", "scaleX", '1.40665'],
                ["color", "color", 'rgba(255,255,255,1)'],
                ["style", "font-family", 'Arial, Helvetica, sans-serif'],
                ["style", "left", '717px'],
                ["style", "font-size", '12px']
            ],
            "${_Text7Copy9}": [
                ["style", "top", '613px'],
                ["transform", "scaleY", '1.40665'],
                ["color", "color", 'rgba(255,233,0,1)'],
                ["transform", "scaleX", '1.40665'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '203px'],
                ["style", "font-size", '15px']
            ],
            "${_Stage}": [
                ["color", "background-color", 'rgba(248,135,0,1.00)'],
                ["style", "min-width", '660px'],
                ["style", "overflow", 'hidden'],
                ["style", "height", '1240px'],
                ["gradient", "background-image", [50,50,true,'farthest-corner',[['rgba(246,208,67,1.00)',26],['rgba(214,70,47,1.00)',100]]]],
                ["style", "max-width", '1200px'],
                ["style", "width", '988px']
            ],
            "${_Rectangle2}": [
                ["color", "background-color", 'rgba(108,42,42,1.00)'],
                ["style", "top", '408px'],
                ["transform", "scaleY", '-7.91219'],
                ["transform", "rotateZ", '32deg'],
                ["transform", "scaleX", '0.90436'],
                ["style", "opacity", '0.36839978448276'],
                ["style", "left", '29px'],
                ["style", "-webkit-transform-origin", [56.21,37.06], {valueTemplate:'@@0@@% @@1@@%'} ],
                ["style", "-moz-transform-origin", [56.21,37.06],{valueTemplate:'@@0@@% @@1@@%'}],
                ["style", "-ms-transform-origin", [56.21,37.06],{valueTemplate:'@@0@@% @@1@@%'}],
                ["style", "msTransformOrigin", [56.21,37.06],{valueTemplate:'@@0@@% @@1@@%'}],
                ["style", "-o-transform-origin", [56.21,37.06],{valueTemplate:'@@0@@% @@1@@%'}]
            ],
            "${_Text8}": [
                ["style", "top", '706px'],
                ["style", "text-align", 'center'],
                ["color", "color", 'rgba(0,0,0,1.00)'],
                ["style", "font-family", 'Arial, Helvetica, sans-serif'],
                ["style", "left", '782px'],
                ["style", "font-size", '20px']
            ],
            "${_Text3Copy3}": [
                ["style", "top", '1197px'],
                ["transform", "scaleY", '1.40665'],
                ["style", "font-size", '10px'],
                ["transform", "scaleX", '1.40665'],
                ["color", "color", 'rgba(255,230,0,1)'],
                ["style", "left", '906px'],
                ["style", "width", '78px']
            ],
            "${_Text14Copy2}": [
                ["subproperty", "filter.drop-shadow.color", 'rgba(4,4,4,1.00)'],
                ["style", "text-align", 'justify'],
                ["style", "width", '448px'],
                ["transform", "scaleX", '1'],
                ["style", "font-weight", '100'],
                ["subproperty", "filter.drop-shadow.offsetV", '2px'],
                ["subproperty", "filter.drop-shadow.blur", '0px'],
                ["style", "top", '917px'],
                ["subproperty", "filter.drop-shadow.offsetH", '2px'],
                ["transform", "scaleY", '1'],
                ["color", "color", 'rgba(255,255,255,1.00)'],
                ["style", "height", '258px'],
                ["style", "font-family", 'Verdana, Geneva, sans-serif'],
                ["style", "font-size", '22px'],
                ["style", "left", '30px']
            ],
            "${_Text7Copy}": [
                ["style", "top", '379px'],
                ["transform", "scaleY", '1.40665'],
                ["color", "color", 'rgba(255,233,0,1.00)'],
                ["transform", "scaleX", '1.40665'],
                ["style", "font-family", 'Arial Black, Gadget, sans-serif'],
                ["style", "left", '168px'],
                ["style", "font-size", '15px']
            ],
            "${_Text4}": [
                ["style", "top", '301px'],
                ["style", "font-size", '28px'],
                ["style", "left", '182px'],
                ["subproperty", "filter.drop-shadow.color", 'rgba(0,0,0,0.631373)'],
                ["style", "width", '185px'],
                ["style", "font-family", 'Arial, Helvetica, sans-serif'],
                ["subproperty", "filter.drop-shadow.offsetV", '1px'],
                ["subproperty", "filter.drop-shadow.offsetH", '1px']
            ],
            "${_Text3Copy6}": [
                ["style", "top", '1176px'],
                ["transform", "scaleY", '1.40665'],
                ["transform", "scaleX", '1.40665'],
                ["style", "font-size", '9px'],
                ["style", "left", '719px'],
                ["style", "width", '78px']
            ],
            "${_Group}": [
                ["style", "top", '1384px'],
                ["style", "left", '696px'],
                ["style", "cursor", 'pointer']
            ],
            "${_RoundRect3Copy11}": [
                ["style", "top", '581px'],
                ["transform", "scaleY", '1.57822'],
                ["transform", "rotateZ", '0deg'],
                ["transform", "scaleX", '1.92446'],
                ["gradient", "background-image", [270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                ["style", "left", '72px'],
                ["style", "clip", [0,137.9140625,64,0], {valueTemplate:'rect(@@0@@px @@1@@px @@2@@px @@3@@px)'} ]
            ],
            "${_Text}": [
                ["style", "top", '348px'],
                ["transform", "scaleX", '1.40665'],
                ["transform", "scaleY", '1.40665'],
                ["style", "left", '104px']
            ],
            "${_manitoCopy}": [
                ["style", "left", '310px'],
                ["style", "top", '1408px']
            ],
            "${_smartphone1}": [
                ["style", "left", '265px'],
                ["style", "top", '302px']
            ],
            "${_Text7Copy6}": [
                ["style", "top", '1176px'],
                ["transform", "scaleY", '1.40665'],
                ["transform", "scaleX", '1.40665'],
                ["color", "color", 'rgba(255,233,0,1)'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '806px'],
                ["style", "font-size", '15px']
            ],
            "${_title}": [
                ["style", "top", '15px'],
                ["transform", "scaleY", '1.5'],
                ["color", "color", 'rgba(255,255,255,1.00)'],
                ["transform", "scaleX", '1.5'],
                ["style", "font-family", 'Verdana, Geneva, sans-serif'],
                ["style", "left", '212px'],
                ["style", "font-size", '25px']
            ],
            "${_Text3}": [
                ["style", "top", '369px'],
                ["transform", "scaleY", '1.40665'],
                ["transform", "scaleX", '1.40665'],
                ["style", "font-size", '12px'],
                ["style", "left", '37px'],
                ["style", "width", '78px']
            ],
            "${_Text3Copy9}": [
                ["style", "top", '931px'],
                ["transform", "scaleY", '1.40665'],
                ["transform", "scaleX", '1.40665'],
                ["style", "width", '78px'],
                ["style", "left", '726px'],
                ["style", "font-size", '10px']
            ],
            "${_RoundRect}": [
                ["color", "background-color", 'rgba(255,255,255,0.51)'],
                ["style", "height", '190px'],
                ["style", "top", '585px'],
                ["style", "left", '655px'],
                ["style", "width", '335px']
            ],
            "${_Text7}": [
                ["style", "top", '392px'],
                ["transform", "scaleY", '1.40665'],
                ["color", "color", 'rgba(255,255,255,1.00)'],
                ["transform", "scaleX", '1.40665'],
                ["style", "font-family", 'Arial, Helvetica, sans-serif'],
                ["style", "left", '32px'],
                ["style", "font-size", '15px']
            ],
            "${_Text11}": [
                ["style", "top", '1389px'],
                ["style", "font-family", 'Arial Black, Gadget, sans-serif'],
                ["style", "left", '587px']
            ],
            "${_Text14}": [
                ["subproperty", "filter.drop-shadow.color", 'rgba(0,0,0,1.00)'],
                ["subproperty", "filter.drop-shadow.offsetH", '2px'],
                ["transform", "scaleX", '1'],
                ["style", "font-weight", '100'],
                ["subproperty", "filter.drop-shadow.offsetV", '2px'],
                ["style", "font-size", '22px'],
                ["style", "top", '302px'],
                ["color", "color", 'rgba(255,255,255,1.00)'],
                ["style", "text-align", 'justify'],
                ["style", "width", '398px'],
                ["style", "height", '248px'],
                ["style", "font-family", 'Verdana, Geneva, sans-serif'],
                ["transform", "scaleY", '1'],
                ["style", "left", '560px']
            ],
            "${_Rectangle2Copy3}": [
                ["color", "background-color", 'rgba(108,42,42,1)'],
                ["transform", "scaleY", '-7.91219'],
                ["transform", "rotateZ", '25deg'],
                ["transform", "scaleX", '0.90436'],
                ["style", "opacity", '0.36839979887008667'],
                ["style", "left", '714px'],
                ["style", "top", '963px']
            ],
            "${_Text5}": [
                ["style", "top", '724px'],
                ["style", "font-family", 'Arial Black, Gadget, sans-serif'],
                ["style", "left", '427px'],
                ["color", "color", 'rgba(0,0,0,1.00)']
            ],
            "${_RectangleCopy4}": [
                ["subproperty", "filter.drop-shadow.color", 'rgba(0,0,0,0.458824)'],
                ["subproperty", "filter.hue-rotate", '0deg'],
                ["gradient", "background-image", [180,[['rgba(191,191,191,1.00)',0],['rgba(255,255,255,1.00)',100]]]],
                ["subproperty", "filter.drop-shadow.offsetV", '3px'],
                ["subproperty", "filter.drop-shadow.blur", '2px'],
                ["style", "top", '1279px'],
                ["transform", "scaleY", '1.19615'],
                ["style", "height", '51px'],
                ["style", "left", '351px'],
                ["style", "width", '236px'],
                ["transform", "scaleX", '1.19615']
            ],
            "${_Rectangle2Copy2}": [
                ["color", "background-color", 'rgba(108,42,42,1)'],
                ["transform", "scaleY", '-7.91219'],
                ["transform", "rotateZ", '-50deg'],
                ["transform", "scaleX", '0.90436'],
                ["style", "opacity", '0.36839979887008667'],
                ["style", "left", '714px'],
                ["style", "top", '963px']
            ],
            "${_TextCopy2}": [
                ["style", "top", '578px'],
                ["style", "text-align", 'center'],
                ["transform", "scaleX", '1.40665'],
                ["style", "left", '86px'],
                ["transform", "scaleY", '1.40665']
            ],
            "${_delgado}": [
                ["style", "top", '264px'],
                ["transform", "scaleX", '0.59321'],
                ["transform", "scaleY", '0.8004'],
                ["style", "left", '484px']
            ],
            "${_RectangleCopy2}": [
                ["subproperty", "filter.drop-shadow.color", 'rgba(0,0,0,0.458824)'],
                ["subproperty", "filter.hue-rotate", '0deg'],
                ["gradient", "background-image", [180,[['rgba(191,191,191,1.00)',0],['rgba(255,255,255,1.00)',100]]]],
                ["subproperty", "filter.drop-shadow.offsetV", '3px'],
                ["subproperty", "filter.drop-shadow.blur", '2px'],
                ["style", "top", '1372px'],
                ["style", "height", '46px'],
                ["style", "left", '101px'],
                ["style", "width", '295px']
            ],
            "${_Rectangle}": [
                ["subproperty", "filter.drop-shadow.color", 'rgba(0,0,0,0.458824)'],
                ["subproperty", "filter.hue-rotate", '0deg'],
                ["gradient", "background-image", [180,[['rgba(191,191,191,1.00)',0],['rgba(255,255,255,1.00)',100]]]],
                ["subproperty", "filter.drop-shadow.offsetV", '3px'],
                ["subproperty", "filter.drop-shadow.blur", '2px'],
                ["style", "top", '1372px'],
                ["style", "height", '46px'],
                ["style", "width", '295px'],
                ["style", "left", '570px']
            ],
            "${_camara2}": [
                ["style", "top", '61px'],
                ["transform", "scaleY", '1.06711'],
                ["transform", "scaleX", '1.06711'],
                ["style", "cursor", 'pointer'],
                ["style", "left", '585px']
            ],
            "${_Text7Copy11}": [
                ["style", "top", '1225px'],
                ["color", "color", 'rgba(0,59,255,1.00)'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '732px'],
                ["style", "font-size", '25px']
            ],
            "${_TextCopy9}": [
                ["transform", "scaleX", '1.40665'],
                ["style", "left", '781px'],
                ["transform", "scaleY", '1.40665'],
                ["style", "top", '904px']
            ],
            "${_RoundRect3Copy10}": [
                ["style", "top", '1134px'],
                ["transform", "scaleY", '1.57822'],
                ["transform", "rotateZ", '-180deg'],
                ["transform", "scaleX", '1.92446'],
                ["gradient", "background-image", [270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                ["style", "left", '744px'],
                ["style", "clip", [0,137.9140625,64,0], {valueTemplate:'rect(@@0@@px @@1@@px @@2@@px @@3@@px)'} ]
            ],
            "${_Text7Copy10}": [
                ["style", "top", '681px'],
                ["color", "color", 'rgba(5,61,248,1.00)'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '34px'],
                ["style", "font-size", '25px']
            ],
            "${_Text7Copy14}": [
                ["style", "top", '929px'],
                ["transform", "scaleY", '1.40665'],
                ["transform", "scaleX", '1.40665'],
                ["color", "color", 'rgba(255,233,0,1)'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '845px'],
                ["style", "font-size", '15px']
            ],
            "${_smarthphone2}": [
                ["style", "top", '852px'],
                ["style", "left", '496px']
            ],
            "${_Text17}": [
                ["color", "color", 'rgba(13,28,233,1.00)'],
                ["style", "left", '749px'],
                ["style", "top", '1387px']
            ],
            "${_RoundRect3Copy12}": [
                ["style", "top", '469px'],
                ["transform", "scaleY", '1.57822'],
                ["transform", "rotateZ", '0deg'],
                ["transform", "scaleX", '1.92446'],
                ["gradient", "background-image", [270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                ["style", "left", '72px'],
                ["style", "clip", [0,137.9140625,64,0], {valueTemplate:'rect(@@0@@px @@1@@px @@2@@px @@3@@px)'} ]
            ],
            "${_Text4Copy}": [
                ["style", "top", '811px'],
                ["style", "width", '205px'],
                ["style", "left", '508px'],
                ["subproperty", "filter.drop-shadow.color", 'rgba(0,0,0,1.00)'],
                ["style", "font-size", '28px'],
                ["style", "font-family", 'Arial, Helvetica, sans-serif'],
                ["subproperty", "filter.drop-shadow.offsetV", '2px'],
                ["subproperty", "filter.drop-shadow.offsetH", '2px']
            ],
            "${_Text7Copy8}": [
                ["style", "top", '1035px'],
                ["transform", "scaleY", '1.40665'],
                ["transform", "scaleX", '1.40665'],
                ["color", "color", 'rgba(255,233,0,1)'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '843px'],
                ["style", "font-size", '15px']
            ],
            "${_Text7Copy17}": [
                ["style", "top", '632px'],
                ["color", "color", 'rgba(5,61,248,1)'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '792px'],
                ["style", "font-size", '55px']
            ],
            "${_Text7Copy15}": [
                ["style", "top", '953px'],
                ["transform", "scaleY", '1.40665'],
                ["transform", "scaleX", '1.40665'],
                ["color", "color", 'rgba(255,255,255,1)'],
                ["style", "font-family", 'Arial, Helvetica, sans-serif'],
                ["style", "left", '714px'],
                ["style", "font-size", '15px']
            ],
            "${_Text12}": [
                ["style", "top", '7px'],
                ["style", "font-family", 'Arial, Helvetica, sans-serif'],
                ["style", "left", '0px'],
                ["color", "color", 'rgba(255,255,255,1.00)']
            ],
            "${_Ellipse}": [
                ["style", "top", '0px'],
                ["style", "left", '0px'],
                ["color", "background-color", 'rgba(24,57,202,0.65)']
            ],
            "${_Text7Copy4}": [
                ["style", "top", '475px'],
                ["transform", "scaleY", '1.40665'],
                ["color", "color", 'rgba(255,233,0,1)'],
                ["transform", "scaleX", '1.40665'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '160px'],
                ["style", "font-size", '15px']
            ],
            "${_TextCopy7}": [
                ["style", "top", '1131px'],
                ["style", "text-align", 'center'],
                ["transform", "scaleX", '1.40665'],
                ["style", "left", '763px'],
                ["transform", "scaleY", '1.40665']
            ],
            "${_manitoCopy2}": [
                ["style", "top", '1320px'],
                ["transform", "scaleX", '0.94444'],
                ["transform", "scaleY", '0.94444'],
                ["style", "left", '483px']
            ]
        }
    },
    timelines: {
        "Default Timeline": {
            fromState: "Base State",
            toState: "",
            duration: 454,
            autoPlay: true,
            timeline: [
                { id: "eid53", tween: [ "transform", "${_camara2}", "scaleX", '1.06711', { fromValue: '1.06711'}], position: 454, duration: 0 },
                { id: "eid31", tween: [ "style", "${_Text4}", "top", '266px', { fromValue: '301px'}], position: 0, duration: 454 },
                { id: "eid28", tween: [ "style", "${_title}", "left", '333px', { fromValue: '212px'}], position: 0, duration: 454 },
                { id: "eid69", tween: [ "style", "${_Text4Copy}", "width", '205px', { fromValue: '205px'}], position: 454, duration: 0 },
                { id: "eid72", tween: [ "style", "${_Text4}", "font-size", '28px', { fromValue: '28px'}], position: 454, duration: 0 },
                { id: "eid44", tween: [ "subproperty", "${_Text4Copy}", "filter.drop-shadow.offsetH", '2px', { fromValue: '2px'}], position: 454, duration: 0 },
                { id: "eid80", tween: [ "gradient", "${_Stage}", "background-image", [50,50,true,'farthest-corner',[['rgba(246,208,67,1.00)',26],['rgba(214,70,47,1.00)',100]]], { fromValue: [50,50,true,'farthest-corner',[['rgba(246,208,67,1.00)',26],['rgba(214,70,47,1.00)',100]]]}], position: 0, duration: 0 },
                { id: "eid71", tween: [ "style", "${_Text4Copy}", "top", '811px', { fromValue: '811px'}], position: 454, duration: 0 },
                { id: "eid58", tween: [ "style", "${_Stage}", "height", '1550px', { fromValue: '1240px'}], position: 0, duration: 454 },
                { id: "eid70", tween: [ "style", "${_Text4Copy}", "left", '508px', { fromValue: '508px'}], position: 454, duration: 0 },
                { id: "eid29", tween: [ "style", "${_title}", "top", '61px', { fromValue: '15px'}], position: 0, duration: 454 },
                { id: "eid43", tween: [ "transform", "${_title}", "scaleY", '1.5', { fromValue: '1.5'}], position: 454, duration: 0 },
                { id: "eid48", tween: [ "subproperty", "${_Text4Copy}", "filter.drop-shadow.color", 'rgba(0,0,0,1.00)', { fromValue: 'rgba(0,0,0,1.00)'}], position: 454, duration: 0 },
                { id: "eid79", tween: [ "color", "${_Stage}", "background-color", 'rgba(248,135,0,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(248,135,0,1.00)'}], position: 0, duration: 0 },
                { id: "eid49", tween: [ "subproperty", "${_Text4}", "filter.drop-shadow.color", 'rgba(0,0,0,1.00)', { fromValue: 'rgba(0,0,0,0.631373)'}], position: 0, duration: 454 },
                { id: "eid42", tween: [ "transform", "${_title}", "scaleX", '1.5', { fromValue: '1.5'}], position: 454, duration: 0 },
                { id: "eid73", tween: [ "style", "${_Text4}", "width", '185px', { fromValue: '185px'}], position: 454, duration: 0 },
                { id: "eid57", tween: [ "style", "${_Text13}", "top", '90px', { fromValue: '90px'}], position: 454, duration: 0 },
                { id: "eid27", tween: [ "style", "${_camara2}", "left", '837px', { fromValue: '585px'}], position: 0, duration: 454 },
                { id: "eid51", tween: [ "subproperty", "${_Text4}", "filter.drop-shadow.offsetV", '2px', { fromValue: '1px'}], position: 0, duration: 454 },
                { id: "eid26", tween: [ "style", "${_Stage}", "width", '988px', { fromValue: '988px'}], position: 454, duration: 0 },
                { id: "eid12", tween: [ "style", "${_camara2}", "top", '123px', { fromValue: '61px'}], position: 0, duration: 227 },
                { id: "eid13", tween: [ "style", "${_camara2}", "top", '55px', { fromValue: '61px'}], position: 227, duration: 227 },
                { id: "eid11", tween: [ "style", "${_Text12}", "top", '7px', { fromValue: '7px'}], position: 0, duration: 0 },
                { id: "eid10", tween: [ "style", "${_Text12}", "left", '0px', { fromValue: '0px'}], position: 0, duration: 0 },
                { id: "eid56", tween: [ "style", "${_Text13}", "left", '836px', { fromValue: '836px'}], position: 454, duration: 0 },
                { id: "eid30", tween: [ "style", "${_Text4}", "left", '279px', { fromValue: '182px'}], position: 0, duration: 454 },
                { id: "eid74", tween: [ "style", "${_Text13}", "font-size", '18px', { fromValue: '18px'}], position: 454, duration: 0 },
                { id: "eid68", tween: [ "style", "${_Text4Copy}", "font-size", '28px', { fromValue: '28px'}], position: 454, duration: 0 },
                { id: "eid54", tween: [ "transform", "${_camara2}", "scaleY", '1.06711', { fromValue: '1.06711'}], position: 454, duration: 0 },
                { id: "eid50", tween: [ "subproperty", "${_Text4}", "filter.drop-shadow.offsetH", '2px', { fromValue: '1px'}], position: 0, duration: 454 },
                { id: "eid47", tween: [ "subproperty", "${_Text4Copy}", "filter.drop-shadow.offsetV", '2px', { fromValue: '2px'}], position: 454, duration: 0 }            ]
        }
    }
},
"camara": {
    version: "3.0.0",
    minimumCompatibleVersion: "3.0.0",
    build: "3.0.0.322",
    baseState: "Base State",
    scaleToFit: "none",
    centerStage: "none",
    initialState: "Base State",
    gpuAccelerate: false,
    resizeInstances: false,
    content: {
            dom: [
                {
                    id: 'camara',
                    type: 'image',
                    rect: ['0px', '0px', '34px', '29px', 'auto', 'auto'],
                    fill: ['rgba(0,0,0,0)', 'images/camara.svg', '0px', '0px']
                }
            ],
            symbolInstances: [
            ]
        },
    states: {
        "Base State": {
            "${symbolSelector}": [
                ["style", "height", '29px'],
                ["style", "width", '34px']
            ],
            "${_camara}": [
                ["style", "top", '0px'],
                ["style", "left", '0px']
            ]
        }
    },
    timelines: {
        "Default Timeline": {
            fromState: "Base State",
            toState: "",
            duration: 0,
            autoPlay: true,
            timeline: [
            ]
        }
    }
},
"aqui": {
    version: "3.0.0",
    minimumCompatibleVersion: "3.0.0",
    build: "3.0.0.322",
    baseState: "Base State",
    scaleToFit: "none",
    centerStage: "none",
    initialState: "Base State",
    gpuAccelerate: false,
    resizeInstances: false,
    content: {
            dom: [
                {
                    font: ['Arial, Helvetica, sans-serif', 16, 'rgba(12,22,174,1.00)', '100', 'none', 'normal'],
                    type: 'text',
                    id: 'Text10',
                    text: 'RESERVE AQUI',
                    align: 'left',
                    rect: ['0px', '0px', 'auto', 'auto', 'auto', 'auto']
                }
            ],
            symbolInstances: [
            ]
        },
    states: {
        "Base State": {
            "${_Text10}": [
                ["color", "color", 'rgba(12,22,174,1.00)'],
                ["style", "top", '0px'],
                ["style", "left", '0px'],
                ["style", "font-size", '16px']
            ],
            "${symbolSelector}": [
                ["style", "height", '18px'],
                ["style", "width", '177px']
            ]
        }
    },
    timelines: {
        "Default Timeline": {
            fromState: "Base State",
            toState: "",
            duration: 0,
            autoPlay: true,
            timeline: [
            ]
        }
    }
}
};


Edge.registerCompositionDefn(compId, symbols, fonts, resources, opts);

/**
 * Adobe Edge DOM Ready Event Handler
 */
$(window).ready(function() {
     Edge.launchComposition(compId);
});
})(jQuery, AdobeEdge, "EDGE-79003129");
