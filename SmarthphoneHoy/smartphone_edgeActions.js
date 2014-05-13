/***********************
* Acciones de composición de Adobe Edge Animate
*
* Editar este archivo con precaución, teniendo cuidado de conservar 
* las firmas de función y los comentarios que comienzan con "Edge" para mantener la 
* capacidad de interactuar con estas acciones en Adobe Edge Animate
*
***********************/
(function($, Edge, compId){
var Composition = Edge.Composition, Symbol = Edge.Symbol; // los alias más comunes para las clases de Edge

   //Edge symbol: 'stage'
   (function(symbolName) {
      
      
      Symbol.bindElementAction(compId, symbolName, "${_camara2}", "click", function(sym, e) {
         // Ir a una nueva dirección URL en la ventana actual
         // (sustituya "_self" por un atributo de destino para una nueva ventana)
         window.open("https://www.youtube.com/watch?v=tGx44pPiVxY&index=2&list=PLLSDIHSJqOp0LOusqYQDUKiKfGSRBDUC6", "_blanck");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Group3}", "click", function(sym, e) {
         // Ir a una nueva dirección URL en la ventana actual
         // (sustituya "_self" por un atributo de destino para una nueva ventana)
         window.open("basesdelapromocion.pdf", "_blanck");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_aqui}", "click", function(sym, e) {
         // Ir a una nueva dirección URL en la ventana actual
         // (sustituya "_self" por un atributo de destino para una nueva ventana)
         window.open("http://laprensa-hoy.promocionyreserva.com/reservarHoy.php", "_blanck");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Group}", "click", function(sym, e) {
         // Ir a una nueva dirección URL en la ventana actual
         // (sustituya "_self" por un atributo de destino para una nueva ventana)
         window.open("http://laprensa-hoy.promocionyreserva.com/consulta_hoy_smartphone.php", "_blanck");
         

      });
      //Edge binding end

   })("stage");
   //Edge symbol end:'stage'

})(jQuery, AdobeEdge, "EDGE-79003129");