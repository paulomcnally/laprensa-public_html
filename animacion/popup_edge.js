/**
 * Adobe Edge: symbol definitions
 */
(function($, Edge, compId){
//images folder
var im='images/';

var fonts = {};    fonts['gruppo, sans-serif']='<script src=\"http://use.edgefonts.net/gruppo:n4:all.js\"></script>';

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
                id: 'Text2',
                type: 'text',
                rect: ['-12px', '78px','auto','auto','auto', 'auto'],
                text: "SMARTPHONE",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 60, "rgba(255,255,255,1)", "400", "none", "normal"],
                textShadow: ["rgba(0,0,0,0.65098)", 3, 3, 3],
                transform: [[],[],[],['0.83685','1.57336']]
            },
            {
                id: 'Text3',
                type: 'text',
                rect: ['48px', '19px','auto','46px','auto', 'auto'],
                text: "RESERVE SU",
                align: "left",
                font: ['gruppo, sans-serif', 45, "rgba(255,255,255,1)", "200", "none", "normal"],
                textShadow: ["rgba(0,0,0,0.65098)", 2, 2, 0],
                transform: [[],[],[],['1','1.37245']]
            },
            {
                id: 'Text4',
                type: 'text',
                rect: ['245px', '194px','auto','auto','auto', 'auto'],
                text: "AQUÍ",
                align: "left",
                font: ['gruppo, sans-serif', 45, "rgba(255,255,255,1)", "200", "none", "normal"],
                textShadow: ["rgba(0,0,0,0.65098)", 2, 2, 0],
                transform: [[],[],[],['1','1.4682']]
            },
            {
                id: 'cel1',
                type: 'image',
                rect: ['24px', '174px','110px','198px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"cel1.png",'0px','0px']
            },
            {
                id: 'cel2',
                type: 'image',
                rect: ['138px', '174px','102px','198px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"cel2.png",'0px','0px']
            },
            {
                id: 'manito3',
                type: 'rect',
                rect: ['245', '401','auto','auto','auto', 'auto']
            },
            {
                id: 'Rectangle',
                type: 'rect',
                rect: ['0px', '0px','400px','400px','auto', 'auto'],
                cursor: ['pointer'],
                opacity: 0,
                fill: ["rgba(192,192,192,1)"],
                stroke: [0,"rgba(0,0,0,1)","none"]
            }],
            symbolInstances: [
            {
                id: 'manito3',
                symbolName: 'manito',
                autoPlay: {

                }
            }
            ]
        },
    states: {
        "Base State": {
            "${_cel1}": [
                ["style", "top", '174px'],
                ["style", "left", '-114px']
            ],
            "${_Text3}": [
                ["subproperty", "textShadow.blur", '0px'],
                ["subproperty", "textShadow.offsetH", '2px'],
                ["style", "font-weight", '200'],
                ["style", "left", '-293px'],
                ["style", "top", '19px'],
                ["transform", "scaleY", '1.37245'],
                ["style", "height", '46px'],
                ["style", "font-family", 'gruppo, sans-serif'],
                ["subproperty", "textShadow.offsetV", '2px'],
                ["subproperty", "textShadow.color", 'rgba(0,0,0,0.65098)']
            ],
            "${_Text2}": [
                ["subproperty", "textShadow.blur", '3px'],
                ["subproperty", "textShadow.offsetH", '3px'],
                ["transform", "scaleX", '0.83685'],
                ["subproperty", "textShadow.offsetV", '3px'],
                ["style", "left", '-393px'],
                ["style", "font-size", '60px'],
                ["style", "top", '78px'],
                ["transform", "scaleY", '1.57336'],
                ["subproperty", "textShadow.color", 'rgba(0,0,0,0.65098)']
            ],
            "${_Stage}": [
                ["color", "background-color", 'rgba(248,135,0,1.00)'],
                ["style", "overflow", 'hidden'],
                ["style", "height", '400px'],
                ["gradient", "background-image", [50,50,true,'farthest-corner',[['rgba(246,208,68,0.87)',0],['rgba(183,0,0,1.00)',100]]]],
                ["style", "width", '400px']
            ],
            "${_Rectangle}": [
                ["style", "cursor", 'pointer'],
                ["style", "opacity", '0']
            ],
            "${_cel2}": [
                ["style", "left", '404px'],
                ["style", "top", '174px']
            ],
            "${_Text4}": [
                ["style", "top", '194px'],
                ["subproperty", "textShadow.offsetH", '2px'],
                ["transform", "scaleY", '1.4682'],
                ["subproperty", "textShadow.offsetV", '2px'],
                ["style", "font-family", 'gruppo, sans-serif'],
                ["subproperty", "textShadow.color", 'rgba(0,0,0,0.65098)'],
                ["style", "left", '402px'],
                ["subproperty", "textShadow.blur", '0px']
            ]
        }
    },
    timelines: {
        "Default Timeline": {
            fromState: "Base State",
            toState: "",
            duration: 2750,
            autoPlay: true,
            timeline: [
                { id: "eid4", tween: [ "style", "${_Text2}", "left", '-12px', { fromValue: '-393px'}], position: 459, duration: 541 },
                { id: "eid6", tween: [ "style", "${_cel1}", "left", '24px', { fromValue: '-114px'}], position: 1000, duration: 433, easing: "easeInOutCirc" },
                { id: "eid8", tween: [ "style", "${_cel2}", "left", '138px', { fromValue: '404px'}], position: 1433, duration: 446, easing: "easeInOutSine" },
                { id: "eid2", tween: [ "style", "${_Text3}", "left", '48px', { fromValue: '-293px'}], position: 0, duration: 459 },
                { id: "eid10", tween: [ "style", "${_Text4}", "left", '245px', { fromValue: '402px'}], position: 1879, duration: 371, easing: "easeInOutSine" }            ]
        }
    }
},
"manito": {
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
                    transform: [[0, 0], ['40']],
                    id: 'manito',
                    type: 'image',
                    rect: ['16px', '-130px', '110px', '92px', 'auto', 'auto'],
                    fill: ['rgba(0,0,0,0)', 'images/manito.svg', '0px', '0px']
                }
            ],
            symbolInstances: [
            ]
        },
    states: {
        "Base State": {
            "${_manito}": [
                ["style", "top", '25px'],
                ["transform", "rotateZ", '40deg'],
                ["style", "height", '92px'],
                ["style", "left", '16px'],
                ["style", "width", '110px']
            ],
            "${symbolSelector}": [
                ["style", "height", '141px'],
                ["style", "width", '143px']
            ]
        }
    },
    timelines: {
        "Default Timeline": {
            fromState: "Base State",
            toState: "",
            duration: 2750,
            autoPlay: true,
            timeline: [
                { id: "eid12", tween: [ "style", "${_manito}", "top", '-129px', { fromValue: '25px'}], position: 2250, duration: 500, easing: "swing" }            ]
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
})(jQuery, AdobeEdge, "EDGE-410526");
