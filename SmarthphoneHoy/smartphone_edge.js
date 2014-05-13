/**
 * Adobe Edge: symbol definitions
 */
(function($, Edge, compId){
//images folder
var im='images/';

var fonts = {};    fonts['source-sans-pro, sans-serif']='<script src=\"http://use.edgefonts.net/source-sans-pro:n4,n9,n7,i7,i4,n3,i3,n6,i6,i9,n2,i2:all.js\"></script>';

var opts = {};
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
                rect: ['152px', '43px','440px','auto','auto', 'auto'],
                text: "SMARTPHONE",
                align: "left",
                font: ['Lucida Console, Monaco, monospace', 66, "rgba(255,255,255,1)", "100", "none", "normal"],
                filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(0,0,0,0.58)", 1, 1, 0],
                transform: [[],[],[],['0.77272','1.12895']]
            },
            {
                id: 'doblechip',
                type: 'image',
                rect: ['270px', '150px','186px','143px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"doblechip.png",'0px','0px']
            },
            {
                id: 'RoundRect3',
                type: 'rect',
                rect: ['12px', '502px','148px','64px','auto', 'auto'],
                clip: ['rect(0px 137.9140625px 64px 0px)'],
                borderRadius: ["10px", "10px", "10px", "10px"],
                fill: ["rgba(192,192,192,1)",[270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                stroke: [0,"rgba(0,0,0,1)","none"]
            },
            {
                id: 'Text5',
                type: 'text',
                rect: ['159', '748','auto','auto','auto', 'auto'],
                text: "Este 14 de mayo<br>busque su cuponera",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 18, "rgba(255,255,255,1)", "100", "none", "normal"]
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
                rect: ['147px', '341px','208px','397px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"smartphone1.png",'0px','0px']
            },
            {
                id: 'smarthphone2',
                type: 'image',
                rect: ['377px', '346px','202px','394px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"smarthphone2.png",'0px','0px']
            },
            {
                id: 'Rectangle',
                type: 'rect',
                rect: ['246px', '825px','131px','100px','auto', 'auto'],
                fill: ["rgba(40,125,125,1)",[180,[['rgba(191,191,191,1.00)',0],['rgba(255,255,255,1.00)',100]]]],
                stroke: [0,"rgb(0, 0, 0)","none"],
                filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(0,0,0,0.46)", 0, 3, 2]
            },
            {
                id: 'icon1',
                type: 'image',
                rect: ['267px', '797px','75px','71px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"icon1.png",'0px','0px'],
                filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(255,255,255,1.00)", 1, 1, 0]
            },
            {
                id: 'Text8',
                type: 'text',
                rect: ['261px', '871px','105px','50px','auto', 'auto'],
                text: "Busque la caponera<br>inserta en LA PRENSA el 14 <br>de mayo.",
                align: "left",
                font: ['Verdana, Geneva, sans-serif', 10, "rgba(6,62,121,1.00)", "100", "none", "normal"],
                filter: [0, 0, 0.72, 0.99, 0, 0, 0, 0, "rgba(0,0,0,0)", 0, 0, 0]
            },
            {
                id: 'Text9',
                type: 'text',
                rect: ['187px', '824px','auto','auto','auto', 'auto'],
                text: "1",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 45, "rgba(4,39,251,1.00)", "100", "none", "normal"],
                filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(0,0,0,0.50)", 2, 1, 0]
            },
            {
                id: 'Text9Copy',
                type: 'text',
                rect: ['406px', '823px','auto','auto','auto', 'auto'],
                text: "2",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 45, "rgba(4,39,251,1.00)", "100", "none", "normal"],
                filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(0,0,0,0.50)", 2, 1, 0]
            },
            {
                id: 'Text9Copy2',
                type: 'text',
                rect: ['33px', '983px','auto','auto','auto', 'auto'],
                text: "3",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 45, "rgba(4,39,251,1.00)", "100", "none", "normal"],
                filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(0,0,0,0.70)", 2, 1, 0]
            },
            {
                id: 'Text9Copy3',
                type: 'text',
                rect: ['307px', '985px','auto','auto','auto', 'auto'],
                text: "4",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 45, "rgba(4,39,251,1.00)", "100", "none", "normal"],
                filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(0,0,0,0.50)", 2, 1, 0]
            },
            {
                id: 'logogallo',
                type: 'image',
                rect: ['28px', '1130px','130px','81px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"logogallo.png",'0px','0px']
            },
            {
                id: 'Text13',
                type: 'text',
                rect: ['626px', '138px','auto','auto','auto', 'auto'],
                text: "ver video",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 11, "rgba(255,255,255,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text14',
                type: 'text',
                rect: ['7px', '232px','137px','249px','auto', 'auto'],
                text: "Cámara trasera 8 Mpx i con flash LED, Cámara frontal<br><br>Wifi<br><br>Lector MicroSD hasta 32 GB<br><br>Radio FM<br><br>CPU MTK6572 Dual Core 1.3 GHz<br><br>Bluetooth 4.0<br><br>Memoria 512 MB<br><br>GPS<br><br>Almacenamiento 4GB<br><br>Pantalla Multi-táctil capacitiva de 4¨",
                align: "right",
                font: ['Verdana, Geneva, sans-serif', 9, "rgba(255,255,255,1)", "100", "none", "normal"]
            },
            {
                id: 'camara2',
                type: 'rect',
                rect: ['591', '185','auto','auto','auto', 'auto'],
                cursor: ['pointer']
            },
            {
                id: 'Group3Copy',
                type: 'group',
                rect: ['251', '760','221px','24','auto', 'auto'],
                c: [
                {
                    id: 'Group2Copy',
                    type: 'group',
                    rect: ['0px', '0px','191','24','auto', 'auto'],
                    c: [
                    {
                        id: 'RoundRectCopy',
                        type: 'rect',
                        rect: ['15px', '0px','191px','24px','auto', 'auto'],
                        borderRadius: ["10px", "10px", "10px", "10px"],
                        fill: ["rgba(241,232,39,0.66)"],
                        stroke: [0,"rgba(0,0,0,1)","none"],
                        boxShadow: ["", 3, 3, 3, 0, "rgba(0,0,0,0.65098)"],
                        transform: [[],[],[],['1.12565']]
                    },
                    {
                        id: 'Text6Copy',
                        type: 'text',
                        rect: ['10px', '1px','auto','auto','auto', 'auto'],
                        text: "Bases de la promoción",
                        font: ['Arial, Helvetica, sans-serif', 20, "rgba(215,5,5,1.00)", "normal", "none", ""]
                    }]
                }]
            },
            {
                id: 'manitoCopy2',
                type: 'image',
                rect: ['436px', '772px','36px','30px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"manito3.svg",'0px','0px']
            },
            {
                id: 'Text',
                type: 'text',
                rect: ['53px', '510px','auto','auto','auto', 'auto'],
                text: "CONTADO",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 11, "rgba(255,255,255,1)", "100", "none", "normal"]
            },
            {
                id: 'Text3',
                type: 'text',
                rect: ['21px', '522px','78px','auto','auto', 'auto'],
                text: "Precio regular",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 10, "rgba(255,255,255,1)", "100", "none", "normal"]
            },
            {
                id: 'Text3Copy',
                type: 'text',
                rect: ['95px', '524px','78px','auto','auto', 'auto'],
                text: "A tan solo",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 10, "rgba(255,220,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text7',
                type: 'text',
                rect: ['17px', '537px','auto','auto','auto', 'auto'],
                text: "C$5,799",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 15, "rgba(255,255,255,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text7Copy',
                type: 'text',
                rect: ['81px', '531px','auto','auto','auto', 'auto'],
                text: "C$3,799",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 15, "rgba(255,233,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text7Copy2',
                type: 'text',
                rect: ['77px', '551px','auto','auto','auto', 'auto'],
                text: "IVA INCLUIDO",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 11, "rgba(255,233,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Rectangle2',
                type: 'rect',
                rect: ['11px', '545px','68px','1px','auto', 'auto'],
                opacity: 0.36839978448276,
                fill: ["rgba(108,42,42,1.00)"],
                stroke: [0,"rgb(0, 0, 0)","none"],
                transform: [[],['25'],[],['0.64292','-5.62481']]
            },
            {
                id: 'Rectangle2Copy',
                type: 'rect',
                rect: ['11px', '545px','68px','1px','auto', 'auto'],
                opacity: 0.36839978448276,
                fill: ["rgba(108,42,42,1.00)"],
                stroke: [0,"rgb(0, 0, 0)","none"],
                transform: [[],['-50'],[],['0.64292','-5.62481']]
            },
            {
                id: 'RoundRect3Copy',
                type: 'rect',
                rect: ['12px', '573px','148px','64px','auto', 'auto'],
                clip: ['rect(0px 137.9140625px 64px 0px)'],
                borderRadius: ["10px", "10px", "10px", "10px"],
                fill: ["rgba(192,192,192,1)",[270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                stroke: [0,"rgba(0,0,0,1)","none"]
            },
            {
                id: 'TextCopy',
                type: 'text',
                rect: ['53px', '581px','auto','auto','auto', 'auto'],
                text: "CRÉDITO",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 11, "rgba(255,255,255,1)", "100", "none", "normal"]
            },
            {
                id: 'Text3Copy2',
                type: 'text',
                rect: ['86px', '609px','78px','auto','auto', 'auto'],
                text: "(cuotas<br>quincenales)",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 10, "rgba(255,255,255,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text7Copy5',
                type: 'text',
                rect: ['17px', '595px','auto','auto','auto', 'auto'],
                text: "SIN PRIMA",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 12, "rgba(255,255,255,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text7Copy4',
                type: 'text',
                rect: ['29px', '609px','auto','auto','auto', 'auto'],
                text: "C$207",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 15, "rgba(255,233,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'RoundRect3Copy2',
                type: 'rect',
                rect: ['12px', '651px','148px','64px','auto', 'auto'],
                clip: ['rect(0px 137.9140625px 64px 0px)'],
                borderRadius: ["10px", "10px", "10px", "10px"],
                fill: ["rgba(192,192,192,1)",[270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                stroke: [0,"rgba(0,0,0,1)","none"],
                transform: [[],[],[],['1','1.26563']]
            },
            {
                id: 'TextCopy2',
                type: 'text',
                rect: ['21px', '643px','auto','auto','auto', 'auto'],
                text: "AGREGUE SU <br>ACCESORIO OPCIONAL",
                align: "center",
                font: ['Arial, Helvetica, sans-serif', 11, "rgba(255,255,255,1)", "100", "none", "normal"]
            },
            {
                id: 'Text3Copy4',
                type: 'text',
                rect: ['16px', '675px','78px','auto','auto', 'auto'],
                text: "PROTECTOR <br>DE CELULAR:",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 9, "rgba(255,255,255,1)", "100", "none", "normal"]
            },
            {
                id: 'Text7Copy7',
                type: 'text',
                rect: ['78px', '674px','auto','auto','auto', 'auto'],
                text: "C$249",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 15, "rgba(255,233,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text3Copy5',
                type: 'text',
                rect: ['21px', '702px','78px','auto','auto', 'auto'],
                text: "Crédito",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 10, "rgba(255,230,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text7Copy9',
                type: 'text',
                rect: ['78px', '695px','auto','auto','auto', 'auto'],
                text: "C$13",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 15, "rgba(255,233,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Rectangle3',
                type: 'rect',
                rect: ['0px', '834px','155px','90px','auto', 'auto'],
                fill: ["rgba(246,244,244,0.70)"],
                stroke: [0,"rgb(0, 0, 0)","none"]
            },
            {
                id: 'Text7Copy10',
                type: 'text',
                rect: ['14px', '728px','auto','auto','auto', 'auto'],
                text: "+ 20 CUPONES",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 16, "rgba(255,233,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text16',
                type: 'text',
                rect: ['12px', '847px','auto','auto','auto', 'auto'],
                text: "PASOS PARA<br>OBTENER UN<br>SMARTPHONE:",
                align: "center",
                font: ['Arial, Helvetica, sans-serif', 18, "rgba(9,56,185,1)", "100", "none", "normal"]
            },
            {
                id: 'RoundRect3Copy5',
                type: 'rect',
                rect: ['564px', '497px','148px','64px','auto', 'auto'],
                clip: ['rect(0px 137.9140625px 64px 0px)'],
                borderRadius: ["10px", "10px", "10px", "10px"],
                fill: ["rgba(192,192,192,1)",[270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                stroke: [0,"rgba(0,0,0,1)","none"],
                transform: [[],['-180']]
            },
            {
                id: 'RoundRect3Copy4',
                type: 'rect',
                rect: ['564px', '568px','148px','64px','auto', 'auto'],
                clip: ['rect(0px 137.9140625px 64px 0px)'],
                borderRadius: ["10px", "10px", "10px", "10px"],
                fill: ["rgba(192,192,192,1)",[270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                stroke: [0,"rgba(0,0,0,1)","none"],
                transform: [[],['-180']]
            },
            {
                id: 'RoundRect3Copy3',
                type: 'rect',
                rect: ['564px', '646px','148px','64px','auto', 'auto'],
                clip: ['rect(0px 137.9140625px 64px 0px)'],
                borderRadius: ["10px", "10px", "10px", "10px"],
                fill: ["rgba(192,192,192,1)",[270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                stroke: [0,"rgba(0,0,0,1)","none"],
                transform: [[],['-180'],[],['1','1.26563']]
            },
            {
                id: 'Text7Copy11',
                type: 'text',
                rect: ['580px', '723px','auto','auto','auto', 'auto'],
                text: "+ 20 CUPONES",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 16, "rgba(255,233,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'TextCopy5',
                type: 'text',
                rect: ['613px', '505px','auto','auto','auto', 'auto'],
                text: "CONTADO",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 11, "rgba(255,255,255,1)", "100", "none", "normal"]
            },
            {
                id: 'Text3Copy10',
                type: 'text',
                rect: ['581px', '517px','78px','auto','auto', 'auto'],
                text: "Precio regular",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 10, "rgba(255,255,255,1)", "100", "none", "normal"]
            },
            {
                id: 'Text3Copy9',
                type: 'text',
                rect: ['655px', '519px','78px','auto','auto', 'auto'],
                text: "A tan solo",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 10, "rgba(255,220,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text7Copy18',
                type: 'text',
                rect: ['577px', '532px','auto','auto','auto', 'auto'],
                text: "C$4,199",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 15, "rgba(255,255,255,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text7Copy17',
                type: 'text',
                rect: ['641px', '526px','auto','auto','auto', 'auto'],
                text: "C$2,799",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 15, "rgba(255,233,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text7Copy16',
                type: 'text',
                rect: ['637px', '546px','auto','auto','auto', 'auto'],
                text: "IVA INCLUIDO",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 11, "rgba(255,233,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Rectangle2Copy3',
                type: 'rect',
                rect: ['571px', '540px','68px','1px','auto', 'auto'],
                opacity: 0.36839978448276,
                fill: ["rgba(108,42,42,1.00)"],
                stroke: [0,"rgb(0, 0, 0)","none"],
                transform: [[],['25'],[],['0.64292','-5.62481']]
            },
            {
                id: 'Rectangle2Copy2',
                type: 'rect',
                rect: ['571px', '540px','68px','1px','auto', 'auto'],
                opacity: 0.36839978448276,
                fill: ["rgba(108,42,42,1.00)"],
                stroke: [0,"rgb(0, 0, 0)","none"],
                transform: [[],['-50'],[],['0.64292','-5.62481']]
            },
            {
                id: 'TextCopy4',
                type: 'text',
                rect: ['613px', '576px','auto','auto','auto', 'auto'],
                text: "CRÉDITO",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 11, "rgba(255,255,255,1)", "100", "none", "normal"]
            },
            {
                id: 'Text3Copy8',
                type: 'text',
                rect: ['646px', '604px','78px','auto','auto', 'auto'],
                text: "(cuotas<br>quincenales)",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 10, "rgba(255,255,255,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text7Copy15',
                type: 'text',
                rect: ['577px', '590px','auto','auto','auto', 'auto'],
                text: "SIN PRIMA",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 12, "rgba(255,255,255,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text7Copy14',
                type: 'text',
                rect: ['589px', '604px','auto','auto','auto', 'auto'],
                text: "C$152",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 15, "rgba(255,233,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'TextCopy3',
                type: 'text',
                rect: ['581px', '638px','auto','auto','auto', 'auto'],
                text: "AGREGUE SU <br>ACCESORIO OPCIONAL",
                align: "center",
                font: ['Arial, Helvetica, sans-serif', 11, "rgba(255,255,255,1)", "100", "none", "normal"]
            },
            {
                id: 'Text3Copy7',
                type: 'text',
                rect: ['576px', '670px','78px','auto','auto', 'auto'],
                text: "PROTECTOR <br>DE CELULAR:",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 9, "rgba(255,255,255,1)", "100", "none", "normal"]
            },
            {
                id: 'Text7Copy13',
                type: 'text',
                rect: ['638px', '669px','auto','auto','auto', 'auto'],
                text: "C$249",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 15, "rgba(255,233,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text3Copy6',
                type: 'text',
                rect: ['581px', '697px','78px','auto','auto', 'auto'],
                text: "Crédito",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 10, "rgba(255,230,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text7Copy12',
                type: 'text',
                rect: ['638px', '690px','auto','auto','auto', 'auto'],
                text: "C$13",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 15, "rgba(255,233,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text14Copy2',
                type: 'text',
                rect: ['580px', '232px','137px','249px','auto', 'auto'],
                text: "Cámara trasera 3 Mpx i con flash LED, Cámara frontal<br><br>Wifi<br><br>Lector MicroSD hasta 32 GB<br><br>Radio FM<br><br>CPU MTK6572 Dual Core 1 GHz<br><br>Bluetooth 4.0<br><br>Memoria 512 MB<br><br>GPS<br><br>Almacenamiento 4GB<br><br>Pantalla Multi-táctil capacitiva de 4¨",
                align: "left",
                font: ['Verdana, Geneva, sans-serif', 9, "rgba(255,255,255,1)", "100", "none", "normal"]
            },
            {
                id: 'Text15',
                type: 'text',
                rect: ['162px', '878px','auto','auto','auto', 'auto'],
                text: "BUSQUE",
                align: "left",
                font: ['\'Arial Black\', Gadget, sans-serif', 15, "rgba(215,0,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'Text15Copy',
                type: 'text',
                rect: ['386px', '878px','auto','auto','auto', 'auto'],
                text: "RESERVE",
                align: "left",
                font: ['\'Arial Black\', Gadget, sans-serif', 15, "rgba(215,0,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'RectangleCopy4',
                type: 'rect',
                rect: ['473px', '825px','236px','100px','auto', 'auto'],
                fill: ["rgba(40,125,125,1)",[180,[['rgba(191,191,191,1.00)',0],['rgba(255,255,255,1.00)',100]]]],
                stroke: [0,"rgb(0, 0, 0)","none"],
                filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(0,0,0,0.46)", 0, 3, 2]
            },
            {
                id: 'Text8Copy',
                type: 'text',
                rect: ['498px', '837px','200px','34px','auto', 'auto'],
                text: "Reserve su smartphone<br>AIRIS del 14 al 20 de mayo:<br><br>",
                align: "justify",
                font: ['Verdana, Geneva, sans-serif', 10, "rgba(6,62,121,1.00)", "100", "none", "normal"],
                filter: [0, 0, 0.72, 0.99, 0, 0, 0, 0, "rgba(0,0,0,0)", 0, 0, 0]
            },
            {
                id: 'Text15Copy2',
                type: 'text',
                rect: ['17px', '1039px','auto','auto','auto', 'auto'],
                text: "LLÉNELA",
                align: "left",
                font: ['\'Arial Black\', Gadget, sans-serif', 15, "rgba(215,0,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'RectangleCopy5',
                type: 'rect',
                rect: ['105px', '989px','186px','100px','auto', 'auto'],
                fill: ["rgba(40,125,125,1)",[180,[['rgba(191,191,191,1.00)',0],['rgba(255,255,255,1.00)',100]]]],
                stroke: [0,"rgb(0, 0, 0)","none"],
                filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(0,0,0,0.46)", 0, 3, 2]
            },
            {
                id: 'icon4',
                type: 'image',
                rect: ['114px', '951px','105px','64px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"icon4.png",'0px','0px'],
                filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(255,255,255,1.00)", 1, 1, 0]
            },
            {
                id: 'Text8Copy2',
                type: 'text',
                rect: ['115px', '1017px','167px','73px','auto', 'auto'],
                text: "Llene la cartilla con los 20 cupones que saldrán en LA PRENSA  a partir del miércoles 14 de mayo hasta el 10 de junio 2014",
                align: "justify",
                font: ['Verdana, Geneva, sans-serif', 10, "rgba(6,62,121,1.00)", "100", "none", "normal"],
                filter: [0, 0, 0.72, 0.99, 0, 0, 0, 0, "rgba(0,0,0,0)", 0, 0, 0]
            },
            {
                id: 'Text15Copy3',
                type: 'text',
                rect: ['301px', '1039px','auto','auto','auto', 'auto'],
                text: "CANJEE",
                align: "left",
                font: ['\'Arial Black\', Gadget, sans-serif', 15, "rgba(215,0,0,1.00)", "100", "none", "normal"]
            },
            {
                id: 'RectangleCopy6',
                type: 'rect',
                rect: ['380px', '989px','274px','100px','auto', 'auto'],
                fill: ["rgba(40,125,125,1)",[180,[['rgba(191,191,191,1.00)',0],['rgba(255,255,255,1.00)',100]]]],
                stroke: [0,"rgb(0, 0, 0)","none"],
                filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(0,0,0,0.46)", 0, 3, 2]
            },
            {
                id: 'icon5',
                type: 'image',
                rect: ['563px', '877px','115px','63px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"icon5.png",'0px','0px']
            },
            {
                id: 'Text8Copy3',
                type: 'text',
                rect: ['392px', '1014px','250px','81px','auto', 'auto'],
                text: "Espere un mensaje de texto y preséntese a la tienda El Gallo más Gallo donde reservó, entregue su cartilla llena y la cantidad en córdobas para retirar su Smartphone AIRIS o bien lléveselo al crédito y sin prima.",
                align: "justify",
                font: ['Verdana, Geneva, sans-serif', 10, "rgba(6,62,121,1.00)", "100", "none", "normal"],
                filter: [0, 0, 0.72, 0.99, 0, 0, 0, 0, "rgba(0,0,0,0)", 0, 0, 0]
            },
            {
                id: 'aqui',
                type: 'rect',
                rect: ['503', '879','auto','auto','auto', 'auto'],
                cursor: ['default']
            },
            {
                id: 'manito',
                type: 'image',
                rect: ['590px', '895px','36px','30px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"manito.svg",'0px','0px']
            },
            {
                id: 'Text11',
                type: 'text',
                rect: ['424px', '1102px','auto','auto','auto', 'auto'],
                text: "CONSULTE",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 16, "rgba(12,22,174,1)", "100", "none", "normal"]
            },
            {
                id: 'Group',
                type: 'group',
                rect: ['533', '1100','42','30','auto', 'auto'],
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
                rect: ['583px', '1107px','auto','auto','auto', 'auto'],
                text: "su inscripción",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 16, "rgba(13,28,233,1.00)", "100", "none", "normal"]
            },
            {
                id: 'logohoy',
                type: 'image',
                rect: ['587px', '1145px','114px','75px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"logohoy.png",'0px','0px']
            },
            {
                id: 'Group3',
                type: 'group',
                rect: ['251', '760','221px','24','auto', 'auto'],
                cursor: ['default'],
                c: [
                {
                    id: 'Group2',
                    type: 'group',
                    rect: ['0px', '0px','191','24','auto', 'auto'],
                    c: [
                    {
                        id: 'RoundRect',
                        type: 'rect',
                        rect: ['15px', '0px','191px','24px','auto', 'auto'],
                        borderRadius: ["10px", "10px", "10px", "10px"],
                        fill: ["rgba(241,232,39,0.66)"],
                        stroke: [0,"rgba(0,0,0,1)","none"],
                        boxShadow: ["", 3, 3, 3, 0, "rgba(0,0,0,0.65098)"],
                        transform: [[],[],[],['1.12565']]
                    },
                    {
                        id: 'Text6',
                        type: 'text',
                        rect: ['10px', '1px','auto','auto','auto', 'auto'],
                        text: "Bases de la promoción",
                        font: ['Arial, Helvetica, sans-serif', 20, "rgba(215,5,5,1.00)", "normal", "none", ""]
                    }]
                }]
            },
            {
                id: 'manitoCopy',
                type: 'image',
                rect: ['436px', '772px','36px','30px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"manito2.svg",'0px','0px']
            }],
            symbolInstances: [
            {
                id: 'aqui',
                symbolName: 'aqui',
                autoPlay: {

                }
            },
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
            "${_Group3}": [
                ["style", "cursor", 'default'],
                ["style", "width", '221px']
            ],
            "${_Group3Copy}": [
                ["style", "width", '221px']
            ],
            "${_Text7Copy14}": [
                ["style", "top", '604px'],
                ["color", "color", 'rgba(255,233,0,1)'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '589px'],
                ["style", "font-size", '15px']
            ],
            "${_doblechip}": [
                ["style", "top", '150px'],
                ["style", "left", '270px']
            ],
            "${_Text9Copy3}": [
                ["subproperty", "filter.drop-shadow.color", 'rgba(0,0,0,0.498039)'],
                ["style", "font-size", '45px'],
                ["style", "left", '307px'],
                ["style", "top", '985px'],
                ["color", "color", 'rgba(4,39,251,1.00)'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["subproperty", "filter.drop-shadow.offsetV", '1px'],
                ["subproperty", "filter.drop-shadow.offsetH", '2px']
            ],
            "${_Text9Copy}": [
                ["subproperty", "filter.drop-shadow.color", 'rgba(0,0,0,0.498039)'],
                ["style", "font-size", '45px'],
                ["style", "left", '406px'],
                ["style", "top", '823px'],
                ["color", "color", 'rgba(4,39,251,1.00)'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["subproperty", "filter.drop-shadow.offsetV", '1px'],
                ["subproperty", "filter.drop-shadow.offsetH", '2px']
            ],
            "${_title}": [
                ["style", "top", '15px'],
                ["color", "color", 'rgba(255,255,255,1.00)'],
                ["style", "font-family", 'Verdana, Geneva, sans-serif'],
                ["style", "left", '212px'],
                ["style", "font-size", '25px']
            ],
            "${_TextCopy4}": [
                ["style", "top", '576px'],
                ["style", "left", '613px']
            ],
            "${_RoundRect3}": [
                ["style", "top", '502px'],
                ["gradient", "background-image", [270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                ["style", "clip", [0,137.9140625,64,0], {valueTemplate:'rect(@@0@@px @@1@@px @@2@@px @@3@@px)'} ],
                ["style", "left", '12px']
            ],
            "${_Text15Copy}": [
                ["color", "color", 'rgba(215,0,0,1)'],
                ["style", "top", '878px'],
                ["style", "left", '386px'],
                ["style", "font-size", '15px']
            ],
            "${_Text6Copy}": [
                ["color", "color", 'rgba(215,5,5,1)'],
                ["style", "top", '1px'],
                ["style", "left", '10px'],
                ["style", "font-size", '20px']
            ],
            "${_Text7Copy13}": [
                ["style", "top", '669px'],
                ["color", "color", 'rgba(255,233,0,1)'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '638px'],
                ["style", "font-size", '15px']
            ],
            "${_smartphone1}": [
                ["style", "left", '147px'],
                ["style", "top", '341px']
            ],
            "${_Ellipse}": [
                ["style", "top", '0px'],
                ["style", "left", '0px'],
                ["color", "background-color", 'rgba(24,57,202,0.65)']
            ],
            "${_RoundRect3Copy2}": [
                ["style", "top", '651px'],
                ["transform", "scaleY", '1.26563'],
                ["gradient", "background-image", [270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                ["style", "left", '12px'],
                ["style", "clip", [0,137.9140625,64,0], {valueTemplate:'rect(@@0@@px @@1@@px @@2@@px @@3@@px)'} ]
            ],
            "${_TextCopy}": [
                ["style", "top", '581px'],
                ["style", "left", '53px']
            ],
            "${_icon1}": [
                ["subproperty", "filter.drop-shadow.color", 'rgba(255,255,255,1.00)'],
                ["subproperty", "filter.drop-shadow.offsetV", '1px'],
                ["style", "top", '797px'],
                ["style", "left", '267px'],
                ["subproperty", "filter.drop-shadow.offsetH", '1px']
            ],
            "${_Text3Copy8}": [
                ["style", "top", '604px'],
                ["color", "color", 'rgba(255,255,255,1)'],
                ["style", "font-size", '10px'],
                ["style", "left", '646px'],
                ["style", "width", '78px']
            ],
            "${_Text3Copy4}": [
                ["style", "top", '675px'],
                ["style", "font-size", '9px'],
                ["style", "left", '16px'],
                ["style", "width", '78px']
            ],
            "${_icon5}": [
                ["subproperty", "filter.drop-shadow.color", 'rgba(255,255,255,1.00)'],
                ["subproperty", "filter.drop-shadow.offsetV", '1px'],
                ["style", "top", '951px'],
                ["style", "left", '395px'],
                ["subproperty", "filter.drop-shadow.offsetH", '1px']
            ],
            "${_Text7Copy7}": [
                ["style", "top", '674px'],
                ["color", "color", 'rgba(255,233,0,1)'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '78px'],
                ["style", "font-size", '15px']
            ],
            "${_Text7Copy16}": [
                ["style", "top", '546px'],
                ["color", "color", 'rgba(255,233,0,1)'],
                ["style", "font-family", 'Arial, Helvetica, sans-serif'],
                ["style", "left", '637px'],
                ["style", "font-size", '11px']
            ],
            "${_Text7Copy2}": [
                ["style", "top", '551px'],
                ["color", "color", 'rgba(255,233,0,1)'],
                ["style", "font-family", 'Arial, Helvetica, sans-serif'],
                ["style", "left", '77px'],
                ["style", "font-size", '11px']
            ],
            "${_manito}": [
                ["style", "left", '590px'],
                ["style", "top", '895px']
            ],
            "${_Text3Copy2}": [
                ["style", "top", '609px'],
                ["color", "color", 'rgba(255,255,255,1.00)'],
                ["style", "width", '78px'],
                ["style", "left", '86px'],
                ["style", "font-size", '10px']
            ],
            "${_Rectangle2Copy}": [
                ["color", "background-color", 'rgba(108,42,42,1)'],
                ["transform", "scaleY", '-5.62481'],
                ["transform", "rotateZ", '-50deg'],
                ["transform", "scaleX", '0.64292'],
                ["style", "opacity", '0.36839979887008667'],
                ["style", "left", '11px'],
                ["style", "top", '545px']
            ],
            "${_Text13}": [
                ["color", "color", 'rgba(255,255,255,1.00)'],
                ["style", "left", '626px'],
                ["style", "top", '138px']
            ],
            "${_Text6}": [
                ["color", "color", 'rgba(215,5,5,1)'],
                ["style", "top", '1px'],
                ["style", "left", '10px'],
                ["style", "font-size", '20px']
            ],
            "${_logogallo}": [
                ["style", "left", '28px'],
                ["style", "top", '1130px']
            ],
            "${_Text}": [
                ["style", "top", '510px'],
                ["style", "left", '53px']
            ],
            "${_Text7Copy9}": [
                ["style", "top", '695px'],
                ["color", "color", 'rgba(255,233,0,1)'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '78px'],
                ["style", "font-size", '15px']
            ],
            "${_aqui}": [
                ["style", "cursor", 'default']
            ],
            "${_Text15Copy2}": [
                ["color", "color", 'rgba(215,0,0,1)'],
                ["style", "top", '1039px'],
                ["style", "left", '17px'],
                ["style", "font-size", '15px']
            ],
            "${_Text15}": [
                ["style", "top", '878px'],
                ["color", "color", 'rgba(215,0,0,1.00)'],
                ["style", "left", '162px'],
                ["style", "font-size", '15px']
            ],
            "${_RoundRectCopy}": [
                ["color", "background-color", 'rgba(241,232,39,0.6588)'],
                ["subproperty", "boxShadow.color", 'rgba(0,0,0,0.65098)'],
                ["subproperty", "boxShadow.blur", '3px'],
                ["style", "left", '15px'],
                ["transform", "scaleX", '1.12565'],
                ["subproperty", "boxShadow.offsetV", '3px'],
                ["subproperty", "boxShadow.offsetH", '3px'],
                ["style", "top", '0px']
            ],
            "${_Text7Copy12}": [
                ["style", "top", '690px'],
                ["color", "color", 'rgba(255,233,0,1)'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '638px'],
                ["style", "font-size", '15px']
            ],
            "${_manitoCopy}": [
                ["style", "left", '436px'],
                ["style", "top", '772px']
            ],
            "${_Text8}": [
                ["subproperty", "filter.contrast", '0.72'],
                ["color", "color", 'rgba(6,62,121,1.00)'],
                ["style", "left", '261px'],
                ["style", "font-size", '10px'],
                ["style", "top", '871px'],
                ["style", "text-align", 'left'],
                ["style", "height", '50px'],
                ["style", "font-family", 'Verdana, Geneva, sans-serif'],
                ["subproperty", "filter.saturate", '0.99'],
                ["style", "width", '105px']
            ],
            "${_RectangleCopy5}": [
                ["subproperty", "filter.drop-shadow.color", 'rgba(0,0,0,0.458824)'],
                ["subproperty", "filter.hue-rotate", '0deg'],
                ["gradient", "background-image", [180,[['rgba(191,191,191,1.00)',0],['rgba(255,255,255,1.00)',100]]]],
                ["subproperty", "filter.drop-shadow.offsetV", '3px'],
                ["subproperty", "filter.drop-shadow.blur", '2px'],
                ["style", "top", '989px'],
                ["style", "height", '100px'],
                ["style", "width", '186px'],
                ["style", "left", '105px']
            ],
            "${_Text3Copy10}": [
                ["style", "top", '517px'],
                ["style", "font-size", '10px'],
                ["style", "left", '581px'],
                ["style", "width", '78px']
            ],
            "${_Stage}": [
                ["color", "background-color", 'rgba(248,135,0,1.00)'],
                ["style", "min-width", '660px'],
                ["style", "overflow", 'hidden'],
                ["style", "height", '1240px'],
                ["gradient", "background-image", [50,50,true,'farthest-corner',[['rgba(246,208,67,1.00)',26],['rgba(214,70,47,1.00)',100]]]],
                ["style", "max-width", '1200px'],
                ["style", "width", '724px']
            ],
            "${_Text7Copy18}": [
                ["style", "top", '532px'],
                ["color", "color", 'rgba(255,255,255,1)'],
                ["style", "font-family", 'Arial, Helvetica, sans-serif'],
                ["style", "left", '577px'],
                ["style", "font-size", '15px']
            ],
            "${_Text14Copy2}": [
                ["transform", "scaleX", '1'],
                ["style", "font-weight", '100'],
                ["style", "left", '580px'],
                ["style", "font-size", '9px'],
                ["style", "top", '232px'],
                ["transform", "scaleY", '1'],
                ["style", "height", '249px'],
                ["style", "font-family", 'Verdana, Geneva, sans-serif'],
                ["style", "width", '137px'],
                ["style", "text-align", 'left']
            ],
            "${_Text3}": [
                ["style", "top", '522px'],
                ["style", "width", '78px'],
                ["style", "left", '21px'],
                ["style", "font-size", '10px']
            ],
            "${_Group2}": [
                ["style", "left", '0px'],
                ["style", "top", '0px']
            ],
            "${_Text7Copy}": [
                ["style", "top", '531px'],
                ["color", "color", 'rgba(255,233,0,1.00)'],
                ["style", "font-family", 'Arial Black, Gadget, sans-serif'],
                ["style", "left", '81px'],
                ["style", "font-size", '15px']
            ],
            "${_Text4}": [
                ["subproperty", "filter.drop-shadow.color", 'rgba(0,0,0,0.63)'],
                ["subproperty", "filter.drop-shadow.offsetH", '1px'],
                ["subproperty", "filter.drop-shadow.offsetV", '1px'],
                ["style", "top", '301px'],
                ["style", "width", '119px'],
                ["style", "font-family", 'Arial, Helvetica, sans-serif'],
                ["style", "left", '182px'],
                ["style", "font-size", '18px']
            ],
            "${_Text7Copy5}": [
                ["style", "top", '595px'],
                ["color", "color", 'rgba(255,255,255,1)'],
                ["style", "font-family", 'Arial, Helvetica, sans-serif'],
                ["style", "left", '17px'],
                ["style", "font-size", '12px']
            ],
            "${_logohoy}": [
                ["style", "left", '587px'],
                ["style", "top", '1145px']
            ],
            "${_Text8Copy2}": [
                ["subproperty", "filter.contrast", '0.72'],
                ["color", "color", 'rgba(6,62,121,1)'],
                ["style", "left", '115px'],
                ["style", "font-size", '10px'],
                ["style", "top", '1017px'],
                ["style", "text-align", 'justify'],
                ["style", "height", '73px'],
                ["style", "font-family", 'Verdana, Geneva, sans-serif'],
                ["style", "width", '167px'],
                ["subproperty", "filter.saturate", '0.99']
            ],
            "${_TextCopy5}": [
                ["style", "top", '505px'],
                ["style", "left", '613px']
            ],
            "${_Text3Copy6}": [
                ["style", "top", '697px'],
                ["color", "color", 'rgba(255,230,0,1)'],
                ["style", "width", '78px'],
                ["style", "left", '581px'],
                ["style", "font-size", '10px']
            ],
            "${_smarthphone2}": [
                ["style", "top", '346px'],
                ["style", "left", '377px']
            ],
            "${_Text3Copy7}": [
                ["style", "top", '670px'],
                ["style", "width", '78px'],
                ["style", "left", '576px'],
                ["style", "font-size", '9px']
            ],
            "${_Text15Copy3}": [
                ["style", "top", '1039px'],
                ["color", "color", 'rgba(215,0,0,1)'],
                ["style", "left", '301px'],
                ["style", "font-size", '15px']
            ],
            "${_Group}": [
                ["style", "cursor", 'pointer']
            ],
            "${_Rectangle3}": [
                ["style", "height", '90px'],
                ["color", "background-color", 'rgba(246,244,244,0.70)'],
                ["style", "width", '155px']
            ],
            "${_Text2}": [
                ["subproperty", "filter.drop-shadow.color", 'rgba(0,0,0,0.58)'],
                ["transform", "scaleX", '0.77272'],
                ["style", "left", '152px'],
                ["style", "font-size", '66px'],
                ["style", "top", '43px'],
                ["transform", "scaleY", '1.12895'],
                ["subproperty", "filter.drop-shadow.offsetV", '1px'],
                ["style", "font-family", 'Lucida Console, Monaco, monospace'],
                ["subproperty", "filter.drop-shadow.offsetH", '1px'],
                ["style", "width", '440px']
            ],
            "${_Text8Copy3}": [
                ["subproperty", "filter.contrast", '0.72'],
                ["color", "color", 'rgba(6,62,121,1)'],
                ["style", "left", '392px'],
                ["style", "font-size", '10px'],
                ["style", "top", '1014px'],
                ["style", "text-align", 'justify'],
                ["style", "height", '81px'],
                ["style", "font-family", 'Verdana, Geneva, sans-serif'],
                ["subproperty", "filter.saturate", '0.99'],
                ["style", "width", '250px']
            ],
            "${_Group2Copy}": [
                ["style", "left", '0px'],
                ["style", "top", '0px']
            ],
            "${_Text9}": [
                ["style", "top", '824px'],
                ["subproperty", "filter.drop-shadow.offsetH", '2px'],
                ["subproperty", "filter.drop-shadow.offsetV", '1px'],
                ["subproperty", "filter.drop-shadow.color", 'rgba(0,0,0,0.50)'],
                ["color", "color", 'rgba(4,39,251,1.00)'],
                ["style", "font-family", 'Arial Black, Gadget, sans-serif'],
                ["style", "left", '187px'],
                ["style", "font-size", '45px']
            ],
            "${_Text8Copy}": [
                ["subproperty", "filter.contrast", '0.72'],
                ["color", "color", 'rgba(6,62,121,1)'],
                ["style", "left", '498px'],
                ["style", "font-size", '10px'],
                ["style", "top", '837px'],
                ["style", "text-align", 'justify'],
                ["style", "height", '34px'],
                ["style", "font-family", 'Verdana, Geneva, sans-serif'],
                ["style", "width", '200px'],
                ["subproperty", "filter.saturate", '0.99']
            ],
            "${_Text3Copy}": [
                ["style", "top", '524px'],
                ["color", "color", 'rgba(255,220,0,1.00)'],
                ["style", "font-size", '10px'],
                ["style", "left", '95px'],
                ["style", "width", '78px']
            ],
            "${_Text3Copy9}": [
                ["style", "top", '519px'],
                ["color", "color", 'rgba(255,220,0,1)'],
                ["style", "width", '78px'],
                ["style", "left", '655px'],
                ["style", "font-size", '10px']
            ],
            "${_RoundRect}": [
                ["color", "background-color", 'rgba(241,232,39,0.6588)'],
                ["subproperty", "boxShadow.color", 'rgba(0,0,0,0.65098)'],
                ["subproperty", "boxShadow.blur", '3px'],
                ["style", "left", '15px'],
                ["transform", "scaleX", '1.12565'],
                ["subproperty", "boxShadow.offsetV", '3px'],
                ["subproperty", "boxShadow.offsetH", '3px'],
                ["style", "top", '0px']
            ],
            "${_Text7}": [
                ["style", "top", '537px'],
                ["color", "color", 'rgba(255,255,255,1.00)'],
                ["style", "font-family", 'Arial, Helvetica, sans-serif'],
                ["style", "left", '17px'],
                ["style", "font-size", '15px']
            ],
            "${_Text11}": [
                ["style", "top", '1102px'],
                ["style", "font-family", 'Arial Black, Gadget, sans-serif'],
                ["style", "left", '424px']
            ],
            "${_Text7Copy11}": [
                ["style", "top", '723px'],
                ["color", "color", 'rgba(255,233,0,1)'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '580px'],
                ["style", "font-size", '16px']
            ],
            "${_Rectangle2Copy3}": [
                ["color", "background-color", 'rgba(108,42,42,1)'],
                ["transform", "scaleY", '-5.62481'],
                ["transform", "rotateZ", '25deg'],
                ["transform", "scaleX", '0.64292'],
                ["style", "opacity", '0.36839979887008667'],
                ["style", "left", '571px'],
                ["style", "top", '540px']
            ],
            "${_Text5}": [
                ["subproperty", "filter.drop-shadow.color", 'rgba(0,0,0,0.57)'],
                ["subproperty", "filter.drop-shadow.offsetH", '2px'],
                ["style", "text-align", 'left'],
                ["style", "left", '23px'],
                ["subproperty", "filter.grayscale", '0.72475903205128'],
                ["style", "top", '144px'],
                ["subproperty", "filter.drop-shadow.offsetV", '1px'],
                ["style", "font-size", '23px']
            ],
            "${_RectangleCopy4}": [
                ["subproperty", "filter.drop-shadow.color", 'rgba(0,0,0,0.458824)'],
                ["subproperty", "filter.hue-rotate", '0deg'],
                ["gradient", "background-image", [180,[['rgba(191,191,191,1.00)',0],['rgba(255,255,255,1.00)',100]]]],
                ["subproperty", "filter.drop-shadow.offsetV", '3px'],
                ["subproperty", "filter.drop-shadow.blur", '2px'],
                ["style", "top", '825px'],
                ["style", "height", '100px'],
                ["style", "width", '236px'],
                ["style", "left", '473px']
            ],
            "${_Rectangle2}": [
                ["color", "background-color", 'rgba(108,42,42,1.00)'],
                ["transform", "scaleY", '-5.62481'],
                ["transform", "rotateZ", '25deg'],
                ["transform", "scaleX", '0.64292'],
                ["style", "opacity", '0.36839978448276'],
                ["style", "left", '11px'],
                ["style", "top", '545px']
            ],
            "${_RoundRect3Copy5}": [
                ["style", "top", '497px'],
                ["transform", "rotateZ", '-180deg'],
                ["gradient", "background-image", [270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                ["style", "left", '564px'],
                ["style", "clip", [0,137.9140625,64,0], {valueTemplate:'rect(@@0@@px @@1@@px @@2@@px @@3@@px)'} ]
            ],
            "${_Text7Copy10}": [
                ["style", "top", '728px'],
                ["color", "color", 'rgba(255,233,0,1)'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '14px'],
                ["style", "font-size", '16px']
            ],
            "${_TextCopy2}": [
                ["style", "top", '643px'],
                ["style", "left", '21px'],
                ["style", "text-align", 'center']
            ],
            "${_RoundRect3Copy4}": [
                ["style", "top", '568px'],
                ["transform", "rotateZ", '-180deg'],
                ["gradient", "background-image", [270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                ["style", "left", '564px'],
                ["style", "clip", [0,137.9140625,64,0], {valueTemplate:'rect(@@0@@px @@1@@px @@2@@px @@3@@px)'} ]
            ],
            "${_Rectangle}": [
                ["subproperty", "filter.drop-shadow.color", 'rgba(0,0,0,0.46)'],
                ["subproperty", "filter.hue-rotate", '0deg'],
                ["gradient", "background-image", [180,[['rgba(191,191,191,1.00)',0],['rgba(255,255,255,1.00)',100]]]],
                ["subproperty", "filter.drop-shadow.offsetV", '3px'],
                ["subproperty", "filter.drop-shadow.blur", '2px'],
                ["style", "top", '825px'],
                ["style", "height", '100px'],
                ["style", "left", '246px'],
                ["style", "width", '131px']
            ],
            "${_camara2}": [
                ["style", "top", '123px'],
                ["style", "left", '585px'],
                ["style", "cursor", 'pointer']
            ],
            "${_Text3Copy5}": [
                ["style", "top", '702px'],
                ["color", "color", 'rgba(255,230,0,1.00)'],
                ["style", "font-size", '10px'],
                ["style", "left", '21px'],
                ["style", "width", '78px']
            ],
            "${_Rectangle2Copy2}": [
                ["color", "background-color", 'rgba(108,42,42,1)'],
                ["transform", "scaleY", '-5.62481'],
                ["transform", "rotateZ", '-50deg'],
                ["transform", "scaleX", '0.64292'],
                ["style", "opacity", '0.36839979887008667'],
                ["style", "left", '571px'],
                ["style", "top", '540px']
            ],
            "${_TextCopy3}": [
                ["style", "top", '638px'],
                ["style", "left", '581px'],
                ["style", "text-align", 'center']
            ],
            "${_Text14}": [
                ["transform", "scaleX", '1'],
                ["style", "font-weight", '100'],
                ["style", "left", '7px'],
                ["style", "font-size", '9px'],
                ["style", "top", '232px'],
                ["transform", "scaleY", '1'],
                ["style", "height", '249px'],
                ["style", "font-family", 'Verdana, Geneva, sans-serif'],
                ["style", "text-align", 'right'],
                ["style", "width", '137px']
            ],
            "${_RoundRect3Copy}": [
                ["style", "top", '573px'],
                ["gradient", "background-image", [270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                ["style", "clip", [0,137.9140625,64,0], {valueTemplate:'rect(@@0@@px @@1@@px @@2@@px @@3@@px)'} ],
                ["style", "left", '12px']
            ],
            "${_RoundRect3Copy3}": [
                ["style", "top", '646px'],
                ["transform", "scaleY", '1.26563'],
                ["transform", "rotateZ", '-180deg'],
                ["gradient", "background-image", [270,[['rgba(255,2,8,1.00)',0],['rgba(140,17,17,1.00)',100]]]],
                ["style", "left", '564px'],
                ["style", "clip", [0,137.9140625,64,0], {valueTemplate:'rect(@@0@@px @@1@@px @@2@@px @@3@@px)'} ]
            ],
            "${_Text17}": [
                ["color", "color", 'rgba(13,28,233,1.00)'],
                ["style", "left", '583px'],
                ["style", "top", '1107px']
            ],
            "${_Text16}": [
                ["style", "left", '12px'],
                ["style", "top", '847px']
            ],
            "${_Text4Copy}": [
                ["subproperty", "filter.drop-shadow.color", 'rgba(0,0,0,0.54)'],
                ["subproperty", "filter.drop-shadow.offsetH", '1px'],
                ["subproperty", "filter.drop-shadow.offsetV", '1px'],
                ["style", "top", '301px'],
                ["style", "font-size", '18px'],
                ["style", "font-family", 'Arial, Helvetica, sans-serif'],
                ["style", "left", '429px'],
                ["style", "width", '119px']
            ],
            "${_Text9Copy2}": [
                ["style", "top", '983px'],
                ["subproperty", "filter.drop-shadow.offsetH", '2px'],
                ["subproperty", "filter.drop-shadow.offsetV", '1px'],
                ["subproperty", "filter.drop-shadow.color", 'rgba(0,0,0,0.70)'],
                ["color", "color", 'rgba(4,39,251,1.00)'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '33px'],
                ["style", "font-size", '45px']
            ],
            "${_Text7Copy17}": [
                ["style", "top", '526px'],
                ["color", "color", 'rgba(255,233,0,1)'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '641px'],
                ["style", "font-size", '15px']
            ],
            "${_Text7Copy15}": [
                ["style", "top", '590px'],
                ["color", "color", 'rgba(255,255,255,1)'],
                ["style", "font-family", 'Arial, Helvetica, sans-serif'],
                ["style", "left", '577px'],
                ["style", "font-size", '12px']
            ],
            "${_Text12}": [
                ["style", "top", '7px'],
                ["style", "font-family", 'Arial, Helvetica, sans-serif'],
                ["style", "left", '0px'],
                ["color", "color", 'rgba(255,255,255,1.00)']
            ],
            "${_RectangleCopy6}": [
                ["subproperty", "filter.drop-shadow.color", 'rgba(0,0,0,0.458824)'],
                ["subproperty", "filter.hue-rotate", '0deg'],
                ["gradient", "background-image", [180,[['rgba(191,191,191,1.00)',0],['rgba(255,255,255,1.00)',100]]]],
                ["subproperty", "filter.drop-shadow.offsetV", '3px'],
                ["subproperty", "filter.drop-shadow.blur", '2px'],
                ["style", "top", '989px'],
                ["style", "height", '100px'],
                ["style", "left", '380px'],
                ["style", "width", '274px']
            ],
            "${_Text7Copy4}": [
                ["style", "top", '609px'],
                ["color", "color", 'rgba(255,233,0,1)'],
                ["style", "font-family", '\'Arial Black\', Gadget, sans-serif'],
                ["style", "left", '29px'],
                ["style", "font-size", '15px']
            ],
            "${_icon4}": [
                ["subproperty", "filter.drop-shadow.color", 'rgba(255,255,255,1.00)'],
                ["subproperty", "filter.drop-shadow.offsetV", '1px'],
                ["style", "top", '951px'],
                ["style", "left", '114px'],
                ["subproperty", "filter.drop-shadow.offsetH", '1px']
            ],
            "${_manitoCopy2}": [
                ["style", "left", '436px'],
                ["style", "top", '772px']
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
                { id: "eid22", tween: [ "style", "${_Text5}", "left", '23px', { fromValue: '23px'}], position: 0, duration: 0 },
                { id: "eid20", tween: [ "style", "${_icon5}", "left", '395px', { fromValue: '395px'}], position: 0, duration: 0 },
                { id: "eid7", tween: [ "style", "${_Text5}", "font-size", '23px', { fromValue: '23px'}], position: 0, duration: 0 },
                { id: "eid21", tween: [ "style", "${_icon5}", "top", '951px', { fromValue: '951px'}], position: 0, duration: 0 },
                { id: "eid88", tween: [ "subproperty", "${_Text4}", "filter.drop-shadow.offsetH", '1px', { fromValue: '1px'}], position: 0, duration: 0 },
                { id: "eid87", tween: [ "subproperty", "${_Text4}", "filter.drop-shadow.color", 'rgba(0,0,0,0.63)', { fromValue: 'rgba(0,0,0,0.63)'}], position: 0, duration: 0 },
                { id: "eid23", tween: [ "style", "${_Text5}", "top", '144px', { fromValue: '144px'}], position: 0, duration: 0 },
                { id: "eid81", tween: [ "subproperty", "${_Text5}", "filter.drop-shadow.color", 'rgba(0,0,0,0.57)', { fromValue: 'rgba(0,0,0,0.57)'}], position: 0, duration: 0 },
                { id: "eid79", tween: [ "color", "${_Stage}", "background-color", 'rgba(248,135,0,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(248,135,0,1.00)'}], position: 0, duration: 0 },
                { id: "eid9", tween: [ "style", "${_Stage}", "height", '1240px', { fromValue: '1240px'}], position: 0, duration: 0 },
                { id: "eid80", tween: [ "gradient", "${_Stage}", "background-image", [50,50,true,'farthest-corner',[['rgba(246,208,67,1.00)',26],['rgba(214,70,47,1.00)',100]]], { fromValue: [50,50,true,'farthest-corner',[['rgba(246,208,67,1.00)',26],['rgba(214,70,47,1.00)',100]]]}], position: 0, duration: 0 },
                { id: "eid25", tween: [ "style", "${_Text4}", "left", '182px', { fromValue: '182px'}], position: 0, duration: 0 },
                { id: "eid11", tween: [ "style", "${_Text12}", "top", '7px', { fromValue: '7px'}], position: 0, duration: 0 },
                { id: "eid17", tween: [ "style", "${_camara2}", "left", '585px', { fromValue: '585px'}], position: 0, duration: 0 },
                { id: "eid89", tween: [ "subproperty", "${_Text4}", "filter.drop-shadow.offsetV", '1px', { fromValue: '1px'}], position: 0, duration: 0 },
                { id: "eid91", tween: [ "subproperty", "${_icon5}", "filter.drop-shadow.color", 'rgba(255,255,255,1.00)', { fromValue: 'rgba(255,255,255,1.00)'}], position: 0, duration: 0 },
                { id: "eid84", tween: [ "subproperty", "${_Text5}", "filter.grayscale", '0.72475903205128', { fromValue: '0.72475903205128'}], position: 0, duration: 0 },
                { id: "eid92", tween: [ "subproperty", "${_icon5}", "filter.drop-shadow.offsetH", '1px', { fromValue: '1px'}], position: 0, duration: 0 },
                { id: "eid10", tween: [ "style", "${_Text12}", "left", '0px', { fromValue: '0px'}], position: 0, duration: 0 },
                { id: "eid93", tween: [ "subproperty", "${_icon5}", "filter.drop-shadow.offsetV", '1px', { fromValue: '1px'}], position: 0, duration: 0 },
                { id: "eid24", tween: [ "style", "${_Text4}", "top", '301px', { fromValue: '301px'}], position: 0, duration: 0 },
                { id: "eid83", tween: [ "subproperty", "${_Text5}", "filter.drop-shadow.offsetV", '1px', { fromValue: '1px'}], position: 0, duration: 0 },
                { id: "eid16", tween: [ "style", "${_camara2}", "top", '123px', { fromValue: '123px'}], position: 0, duration: 0 },
                { id: "eid100", tween: [ "style", "${_title}", "top", '15px', { fromValue: '15px'}], position: 0, duration: 0 },
                { id: "eid82", tween: [ "subproperty", "${_Text5}", "filter.drop-shadow.offsetH", '2px', { fromValue: '2px'}], position: 0, duration: 0 },
                { id: "eid101", tween: [ "style", "${_title}", "left", '212px', { fromValue: '212px'}], position: 0, duration: 0 }            ]
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
            "${_camara}": [
                ["style", "top", '0px'],
                ["style", "left", '0px']
            ],
            "${symbolSelector}": [
                ["style", "height", '29px'],
                ["style", "width", '34px']
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
                    text: 'Click AQUÍ para reservar',
                    align: 'left',
                    rect: ['0px', '0px', 'auto', 'auto', 'auto', 'auto']
                }
            ],
            symbolInstances: [
            ]
        },
    states: {
        "Base State": {
            "${symbolSelector}": [
                ["style", "height", '18px'],
                ["style", "width", '177px']
            ],
            "${_Text10}": [
                ["style", "top", '0px'],
                ["color", "color", 'rgba(12,22,174,1.00)'],
                ["style", "left", '0px'],
                ["style", "font-size", '16px']
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
