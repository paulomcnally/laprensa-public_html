<?php
class regionTable extends Table
{
    function regionTable()
    {
        $this->Table('region');
        $this->title = 'Regiones';
        $this->order = 'creacion DESC';
        $this->key = 'idregion';
        $this->addColumn('idregion', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('region', 'varchar', 50, 0, 0, '<span class="required">Nombre*</span>');
        $this->addColumn('uri', 'varchar', 32, 0, 0, '<span class="required">URI*</span>', array(
            'source' => 'region',
            'apply_funct_js' => 'friendly_url'
        ));
        $this->addColumn('descripcion', 'xhtml', 0, 0, 0, 'Descripción');
        $this->addColumn('orden', 'order', 0, 0, 0, 'Orden');
        $this->addColumn('usuario', 'auth_user', 0, 0, 0, 'Creado por:');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
    }
}
class cargoTable extends Table
{
    function cargoTable()
    {
        $this->Table('cargo');
        $this->title = 'Cargo';
        $this->order = 'cargo';
        $this->key = 'idcargo';
        $this->addColumn('idcargo', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('cargo', 'varchar', 80, 0, 0, '<span class="required">Cargo*</span>');
        $this->addColumn('(SELECT count(idautor) FROM autor WHERE autor.idcargo=cargo.idcargo) AS total', 'external');
    }
}
class autorTable extends Table
{
    function autorTable()
    {
        $this->Table('autor');
        $this->title = 'Autores';
        $this->order = 'autor';
        $this->key = 'idautor';
        $this->maxrows = 30;
        $this->addColumn('idautor', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('autor', 'varchar', 80, 0, 0, '<span class="required">Nombre*</span>');
        $this->addColumn('idcargo', 'int', 0, 0, 'cargo', 'Cargo');
    }
}
class imagenTable extends Table
{
    function imagenTable()
    {
        $this->Table('imagen');
        $this->title = 'Imagenes';
        $this->order = 'creacion DESC';
        $this->key = 'idimagen';
        $this->search = 'credito,claves';
        $this->maxrows = 30;
        $this->addColumn('idimagen', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('imagen', 'image', 0, 0, 0, 'Imagen', array(
            'sizes' => '640x200x1,640x300x1,600x400,397x200x1,300x100x1,360x122x1,271x165x1,270x280x1,397x122x1,288x318,232x155,150x100x1,138x90,120x90x1,150x150x1,77x77x1,53x82x1,48x48x1,1024x1024'
        ));
        $this->addColumn('credito', 'varchar', 500, 0, 0, 'Credito');
        $this->addColumn('claves', 'varchar', 255, 0, 0, 'Etiquetas', array(
            'autocomplete' => true,
            'autocomplete_tb' => 'clave'
        ));
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('cdn', 'auto', 0, 0, 0, 'CDN?');
        $this->addColumn('idedicion', 'auto', 0, 0, 'edicion', 'Edición', array(
            'default' => $_SESSION['edicion']['idedicion']
        ));
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class fotonotaTable extends Table
{
    function fotonotaTable()
    {
        $this->Table('fotonota');
        $this->title = 'fotoNota';
        $this->order = 'creacion DESC';
        $this->key = 'idfotonota';
        $this->maxrows = 30;
        $this->addColumn('idfotonota', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idimagen', 'int', 0, 0, 'imagen', 'Imagen');
        $this->addColumn('idedicion', 'auto', 0, 0, 'edicion', 'Edición', array(
            'default' => $_SESSION['edicion']['idedicion']
        ));
        $this->addColumn('idseccion', 'int', 0, 0, 'seccion', '<span class="required">Sección*</span>');
        $this->addColumn('fotonota', 'varchar', 300, 0, 0, 'Titulo');
        $this->addColumn('texto', 'text', 0, 0, 0, 'Texto');
        $this->addColumn('claves', 'varchar', 255, 0, 0, 'Etiquetas', array(
            'autocomplete' => true,
            'autocomplete_tb' => 'clave'
        ));
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
        $this->addColumn('seccion.uri', 'external');
    }
}
class galeriaTable extends Table
{
    function galeriaTable()
    {
        $this->Table('galeria');
        $this->title = 'Galerias';
        $this->order = 'idgaleria DESC';
        $this->key = 'idgaleria';
        $this->detail = 'coleccion';
        $this->addColumn('idgaleria', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('galeria', 'varchar', 300, 0, 0, '<span class="required">Título*</span>');
        $this->addColumn('descripcion', 'text', 0, 0, 0, 'Descripción');
        $this->addColumn('claves', 'varchar', 255, 0, 0, 'Etiquetas', array(
            'autocomplete' => true,
            'autocomplete_tb' => 'clave'
        ));
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
    }
}
class coleccionTable extends Table
{
    function coleccionTable()
    {
        $this->Table('coleccion');
        $this->title = 'Colección de Imagenes';
        $this->order = 'orden DESC';
        $this->key = 'idcoleccion';
        $this->is_detail = true;
        $this->addColumn('idcoleccion', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idgaleria', 'int', 0, 0, 'galeria', 'Galeria');
        $this->addColumn('idimagen', 'int', 0, 0, 'imagen', 'Imagen');
        $this->addColumn('coleccion', 'varchar', 50, 0, 0, 'Título');
        $this->addColumn('texto', 'xhtml', 0, 0, 0, 'Texto');
        $this->addColumn('orden', 'int', 0, 0, 0, 'Orden');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class mediaTable extends Table
{
    function mediaTable()
    {
        $this->Table('media');
        $this->title = 'Media(Audio)';
        $this->order = 'creacion DESC';
        $this->key = 'idmedia';
        $this->maxrows = 10;
        $this->addColumn('idmedia', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('media', 'file', 0, 0, 0, 'MP3');
        $this->addColumn('resumen', 'text', 0, 0, 0, 'Resumen');
        $this->addColumn('credito', 'varchar', 500, 0, 0, 'Credito');
        $this->addColumn('claves', 'varchar', 255, 0, 0, 'Etiquetas', array(
            'autocomplete' => true,
            'autocomplete_tb' => 'clave'
        ));
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class comentariogaleriaTable extends Table
{
    function comentariogaleriaTable()
    {
        $this->Table('comentariogaleria');
        $this->title = 'Comentarios Galeria';
        $this->order = 'creacion';
        $this->key = 'idcomentariogaleria';
        $this->add = false;
        $this->addColumn('idcomentariogaleria', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idgaleriaminoticia', 'int', 0, 0, 'galeriaminoticia', 'Galeria');
        $this->addColumn('nombre', 'varchar', 50, 0, 0, 'Nombre');
        $this->addColumn('email', 'varchar', 50, 0, 0, 'Email');
        $this->addColumn('web', 'varchar', 300, 0, 0, 'Página Web');
        $this->addColumn('comentariogaleria', 'text', 0, 0, 0, 'Texto');
        $this->addColumn('idusuario', 'int', 0, 0, 'usuario', 'Usuario', array(
            'readonly' => true
        ));
        $this->addColumn('ip', 'auto', 0, 0, 0, 'IP', array(
            'default' => $_SERVER['REMOTE_ADDR']
        ));
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
    }
}
class comentariocaricaturaTable extends Table
{
    function comentariocaricaturaTable()
    {
        $this->Table('comentariocaricatura');
        $this->title = 'Comentarios Caricatura';
        $this->order = 'creacion';
        $this->key = 'idcomentariocaricatura';
        $this->add = false;
        $this->addColumn('idcomentariocaricatura', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idcaricatura', 'int', 0, 0, 'caricatura', 'Caricatura', array(
            'readonly' => true
        ));
        $this->addColumn('nombre', 'varchar', 50, 0, 0, 'Nombre');
        $this->addColumn('email', 'varchar', 50, 0, 0, 'Email');
        $this->addColumn('web', 'varchar', 300, 0, 0, 'Página Web');
        $this->addColumn('comentariocaricatura', 'text', 0, 0, 0, 'Texto');
        $this->addColumn('estado', 'char', 1, 0, 0, 'Estado', array(
            'arr_values' => array(
                'P' => 'en Revisión',
                'B' => 'Bloqueado',
                'A' => 'Aprobado'
            )
        ));
        $this->addColumn('idusuario', 'int', 0, 0, 'usuario', 'Usuario', array(
            'readonly' => true
        ));
        $this->addColumn('ip', 'auto', 0, 0, 0, 'IP', array(
            'default' => $_SERVER['REMOTE_ADDR']
        ));
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
    }
}
class videoTable extends Table
{
    function videoTable()
    {
        $this->Table('video');
        $this->title = 'La Prensa en Video';
        $this->order = 'creacion DESC';
        $this->key = 'idvideo';
        $this->maxrows = 30;
        $this->addColumn('idvideo', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('video', 'varchar', 255, 0, 0, '<span class="required">Título*</span>');
        $this->addColumn('texto', 'xhtml', 0, 0, 0, '<span class="required">Texto*</span>');
        $this->addColumn('archivo', 'file', 0, 0, 0, '<span class="required">Video</span>');
        $this->addColumn('claves', 'varchar', 255, 0, 0, 'Etiquetas', array(
            'autocomplete' => true,
            'autocomplete_tb' => 'clave'
        ));
        $this->addColumn('cdn', 'auto', 0, 0, 0, 'CDN?');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class comentariovideoTable extends Table
{
    function comentariovideoTable()
    {
        $this->Table('comentariovideo');
        $this->title = 'Comentarios Video';
        $this->order = 'creacion';
        $this->key = 'idcomentariovideo';
        $this->add = false;
        $this->addColumn('idcomentariovideo', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idvideo', 'int', 0, 0, 'video', 'Video', array(
            'readonly' => true
        ));
        $this->addColumn('nombre', 'varchar', 50, 0, 0, 'Nombre');
        $this->addColumn('email', 'varchar', 50, 0, 0, 'Email');
        $this->addColumn('web', 'varchar', 300, 0, 0, 'Página Web');
        $this->addColumn('comentariovideo', 'text', 0, 0, 0, 'Texto');
        $this->addColumn('idusuario', 'int', 0, 0, 'usuario', 'Usuario', array(
            'readonly' => true
        ));
        $this->addColumn('ip', 'auto', 0, 0, 0, 'IP', array(
            'default' => $_SERVER['REMOTE_ADDR']
        ));
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
    }
}
class suplementoTable extends Table
{
    function suplementoTable()
    {
        $this->Table('suplemento');
        $this->title = 'Suplementos';
        $this->key = 'idsuplemento';
        $this->maxrows = 20;
        $this->maxcols = 6;
        $this->order = 'orden';
        $this->addColumn('idsuplemento', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('suplemento', 'varchar', 50, 0, 0, '<span class="required">Nombre*</span>');
        $this->addColumn('uri', 'varchar', 32, 0, 0, '<span class="required">URI</span>', array(
            'source' => 'suplemento',
            'apply_funct_js' => 'friendly_url'
        ));
        $this->addColumn('correo', 'varchar', 120, 0, 0, '<span class="required">Correo*</span>');
        $this->addColumn('descripcion', 'text', 0, 0, 0, 'Descripción');
        $this->addColumn('dias', 'varchar', 21, 0, 0, 'Días');
        $this->addColumn('orden', 'order', 0, 0, 0, 'Orden');
        $this->addColumn('color', 'varchar', 6, 0, 0, 'Color encabezado');
        $this->addColumn('color_derecha', 'varchar', 6, 0, 0, 'Color columna derecha');
        $this->addColumn('color_footer', 'varchar', 6, 0, 0, 'Color footer');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('activo', 'bool', 0, 0, 0, 'Activo?');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class seccionsuplementoTable extends Table
{
    function seccionsuplementoTable()
    {
        $this->Table('seccionsuplemento');
        $this->title = 'Secciones';
        $this->order = 'orden';
        $this->key = 'idseccionsuplemento';
        $this->addColumn('idseccionsuplemento', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idsuplemento', 'int', 0, 0, 'suplemento', 'Suplemento');
        $this->addColumn('seccionsuplemento', 'varchar', 50, 0, 0, 'Sección');
        $this->addColumn('uri', 'varchar', 32, 1, 0, '<span class="required">Id/URI*</span>', array(
            'source' => 'seccionsuplemento',
            'apply_funct_js' => 'friendly_url'
        ));
        $this->addColumn('activo', 'bool', 0, 0, 0, 'Activo?');
        $this->addColumn('orden', 'order', 0, 0, 0, 'Orden');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'na_usuario.usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class edicionsuplementoTable extends Table
{
    function edicionsuplementoTable()
    {
        $this->Table('edicionsuplemento');
        $this->title = 'Ediciones';
        $this->order = 'edicionsuplemento DESC';
        $this->key = 'idedicionsuplemento';
        $this->addColumn('idedicionsuplemento', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idsuplemento', 'int', 0, 0, 'suplemento', '<span class="required">Suplemento*</span>');
        $this->addColumn('edicionsuplemento', 'date', 0, 0, 0, 'Fecha Publicacion');
        $this->addColumn('numerosuplemento', 'int', 0, 0, 0, '<span class="required">Edición No.*</span>');
        $this->addColumn('portadasuplemento', 'image', 0, 0, 0, 'Portada', array(
            'sizes' => '270,150x150x1,250,150x174x1,270x280x1'
        ));
        $this->addColumn('suplemento.uri', 'external');
        $this->addColumn('suplemento.color', 'external');
    }
}
class articuloTable extends Table
{
    function articuloTable()
    {
        $this->Table('articulo');
        $this->title = 'Articulos';
        $this->order = 'orden DESC';
        $this->key = 'idarticulo';
        $this->maxrows = 10;
        $this->cache = array(
            strftime("%Y|%m|%d", strtotime($_SESSION['edicion']['edicion'])) . '|suplemento|[uri]|portada',
            strftime("%Y|%m|%d", strtotime($_SESSION['edicion']['edicion'])) . '|suplemento|[uri]|'
        );
        $this->addColumn('idarticulo', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idedicionsuplemento', 'int', 0, 0, 'edicionsuplemento', '<span class="required">Suplemento/Edición*</span>');
        $this->addColumn('idseccionsuplemento', 'int', 0, 0, 'seccionsuplemento', '<span class="required">Sección*</span>');
        $this->addColumn('articulo', 'varchar', 255, 0, 0, '<span class="required">Titulo*</span>');
        $this->addColumn('subtitulo', 'varchar', 100, 0, 0, 'Sub-Titulo');
        $this->addColumn('antetitulo', 'varchar', 100, 0, 0, 'Ante-Titulo');
        $this->addColumn('resumen', 'text', 0, 0, 0, 'Resumen');
        $this->addColumn('intro', 'text', 0, 0, 0, 'Intro');
        $this->addColumn('texto', 'xhtml', 0, 0, 0, '<span class="required">Texto*</span>', array(
            'style' => 'width:600px;height:300px;'
        ));
        $this->addColumn('claves', 'varchar', 255, 0, 0, 'Etiquetas', array(
            'autocomplete' => true,
            'autocomplete_tb' => 'clave'
        ));
        $this->addColumn('estado', 'varchar', 1, 0, 0, 'Estado', array(
            'arr_values' => array(
                'A' => 'Publicad@',
                'D' => 'Borrador',
                'P' => 'Pendiente a Revisión'
            )
        ));
        $this->addColumn('ubicacion', 'char', 1, 0, 0, 'Ubicacion', array(
            'arr_values' => array(
                'D' => 'Derecha',
                'I' => 'Izquierda'
            )
        ));
        $this->addColumn('orden', 'int', 0, 0, 0, 'Orden');
        $this->addColumn('presentar', 'char', 1, 0, 0, 'Presentar');
        $this->addColumn('raiting_1', 'auto', 0, 0, 0, 'Raiting 1');
        $this->addColumn('raiting_2', 'auto', 0, 0, 0, 'Raiting 2');
        $this->addColumn('raiting_3', 'auto', 0, 0, 0, 'Raiting 3');
        $this->addColumn('raiting_4', 'auto', 0, 0, 0, 'Raiting 4');
        $this->addColumn('raiting_5', 'auto', 0, 0, 0, 'Raiting 5');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'na_usuario.usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
        $this->addColumn('(SELECT count(idcomentarioarticulo) FROM comentarioarticulo WHERE idarticulo=articulo.idarticulo AND estado=\'A\') AS comentarios', 'external');
        $this->addColumn('(SELECT uri FROM suplemento WHERE suplemento.idsuplemento=seccionsuplemento.idsuplemento) AS uri', 'external');
    }
}
class aclartTable extends Table
{
    function aclartTable()
    {
        $this->Table('aclart');
        $this->title = 'Sidebar';
        $this->order = 'idaclart';
        $this->key = 'idaclart';
        $this->maxcols = 8;
        $this->is_detail = true;
        $this->addColumn('idaclart', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idarticulo', 'int', 0, 0, 'articulo', 'Articulo');
        $this->addColumn('aclart', 'varchar', 200, 0, 0, "Titulo");
        $this->addColumn('intro', 'text', 0, 0, 0, "Intro");
        $this->addColumn('texto', 'text', 0, 0, 0, "Texto");
    }
}
class relacionadoartTable extends Table
{
    function relacionadoartTable()
    {
        $this->Table('relacionadoart');
        $this->title = 'Relacionados';
        $this->order = 'idrelacionadoart';
        $this->key = 'idrelacionadoart';
        $this->maxcols = 8;
        $this->is_detail = true;
        $this->addColumn('idrelacionadoart', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idarticulo', 'int', 0, 0, 0, 'Articulo');
        $this->addColumn('tipo', 'varchar', 7, 0, 0, "Tipo");
        $this->addColumn('relacionadoart', 'varchar', 255, 0, 0, 'Etiqueta');
        $this->addColumn('enlace', 'varchar', 500, 0, 0, "Enlace");
    }
}
class creditoartTable extends Table
{
    function creditoartTable()
    {
        $this->Table('creditoart');
        $this->title = 'Credito articulo';
        $this->order = 'orden,idcreditoart';
        $this->key = 'idcreditoart';
        $this->maxcols = 8;
        $this->is_detail = true;
        $this->addColumn('idcreditoart', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idarticulo', 'int', 0, 0, 'articulo', 'Articulo');
        $this->addColumn('idautor', 'int', 0, 0, 'autor', '<span class="required">Autor*</span>');
    }
}
class comentarioarticuloTable extends Table
{
    function comentarioarticuloTable()
    {
        $this->Table('comentarioarticulo');
        $this->title = 'Comentarios Articulos';
        $this->order = 'creacion';
        $this->key = 'idcomentarioarticulo';
        $this->add = false;
        $this->addColumn('idcomentarioarticulo', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idarticulo', 'int', 0, 0, 'articulo', 'Articulo');
        $this->addColumn('nombre', 'varchar', 50, 0, 0, 'Nombre');
        $this->addColumn('email', 'varchar', 50, 0, 0, 'Email');
        $this->addColumn('web', 'varchar', 300, 0, 0, 'Página Web');
        $this->addColumn('comentario', 'text', 0, 0, 0, 'Texto');
        $this->addColumn('estado', 'char', 1, 0, 0, 'Estado', array(
            'arr_values' => array(
                'P' => 'en Revisión',
                'B' => 'Bloqueado',
                'A' => 'Aprobado'
            )
        ));
        $this->addColumn('idusuario', 'int', 0, 0, 'usuario', 'Usuario', array(
            'readonly' => true
        ));
        $this->addColumn('ip', 'auto', 0, 0, 0, 'IP', array(
            'default' => $_SERVER['REMOTE_ADDR']
        ));
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
    }
}
class especialTable extends Table
{
    function especialTable()
    {
        $this->Table('especial');
        $this->title = 'Especiales';
        $this->key = 'idespecial';
        $this->maxrows = 20;
        $this->order = 'orden';
        $this->addColumn('idespecial', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('especial', 'varchar', 50, 0, 0, '<span class="required">Nombre*</span>');
        $this->addColumn('uri', 'varchar', 32, 0, 0, '<span class="required">URI*</span>', array(
            'source' => 'especial',
            'apply_funct_js' => 'friendly_url'
        ));
        $this->addColumn('descripcion', 'text', 0, 0, 0, 'Descripción');
        $this->addColumn('orden', 'order', 0, 0, 0, 'Orden');
        $this->addColumn('desde', 'date', 0, 0, 0, 'Desde');
        $this->addColumn('hasta', 'date', 0, 0, 0, 'Hasta');
        $this->addColumn('color', 'varchar', 6, 0, 0, 'Color');
        $this->addColumn('tituloimg', 'image', 0, 0, 0, 'Imagen de titulo', array(
            'sizes' => '150x150,304x57x1,304x176x1'
        ));
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class notaTable extends Table
{
    function notaTable()
    {
        $this->Table('nota');
        $this->title = 'Notas';
        $this->order = 'orden DESC, idnota DESC';
        $this->key = 'idnota';
        $this->maxrows = 10;
        $this->detail = 'creditonota';
        $this->addColumn('idnota', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idespecial', 'int', 0, 0, 'especial', '<span class="required">Especial*</span>');
        $this->addColumn('nota', 'varchar', 255, 0, 0, '<span class="required">Titulo*</span>');
        $this->addColumn('resumen', 'text', 0, 0, 0, 'Resumen');
        $this->addColumn('intro', 'text', 0, 0, 0, 'Intro');
        $this->addColumn('texto', 'xhtml', 0, 0, 0, '<span class="required">Texto*</span>', array(
            'style' => 'width:600px;height:300px;'
        ));
        $this->addColumn('claves', 'varchar', 255, 0, 0, 'Etiquetas', array(
            'autocomplete' => true,
            'autocomplete_tb' => 'clave'
        ));
        $this->addColumn('estado', 'varchar', 1, 0, 0, 'Estado', array(
            'arr_values' => array(
                'P' => 'Publicad@',
                'D' => 'Borrador',
                'R' => 'Pendiente a Revisión'
            )
        ));
        $this->addColumn('orden', 'int', 0, 0, 0, 'Orden');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'na_usuario.usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
        $this->addColumn('especial.desde', 'external');
        $this->addColumn('especial.descripcion', 'external');
        $this->addColumn('especial.hasta', 'external');
        $this->addColumn('especial.tituloimg', 'external');
        $this->addColumn('especial.color', 'external');
        $this->addColumn('especial.uri', 'external');
        $this->addColumn('(SELECT count(idcomentarionota) FROM comentarionota WHERE idnota=nota.idnota AND estado=\'A\') AS comentarios', 'external');
    }
}
class comentarionotaTable extends Table
{
    function comentarionotaTable()
    {
        $this->Table('comentarionota');
        $this->title = 'Comentarios Notas';
        $this->order = 'creacion';
        $this->key = 'idcomentarionota';
        $this->add = false;
        $this->addColumn('idcomentarionota', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idnota', 'int', 0, 0, 'nota', 'Nota');
        $this->addColumn('nombre', 'varchar', 50, 0, 0, 'Nombre');
        $this->addColumn('email', 'varchar', 50, 0, 0, 'Email');
        $this->addColumn('web', 'varchar', 300, 0, 0, 'Página Web');
        $this->addColumn('comentarionota', 'text', 0, 0, 0, 'Texto');
        $this->addColumn('estado', 'char', 1, 0, 0, 'Estado', array(
            'arr_values' => array(
                'P' => 'en Revisión',
                'B' => 'Bloqueado',
                'A' => 'Aprobado'
            )
        ));
        $this->addColumn('idusuario', 'int', 0, 0, 'usuario', 'Usuario', array(
            'readonly' => true
        ));
        $this->addColumn('ip', 'auto', 0, 0, 0, 'IP', array(
            'default' => $_SERVER['REMOTE_ADDR']
        ));
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
    }
}
class aclnotaTable extends Table
{
    function aclnotaTable()
    {
        $this->Table('aclnota');
        $this->title = 'Sidebar';
        $this->order = 'idaclnota';
        $this->key = 'idaclnota';
        $this->maxcols = 8;
        $this->is_detail = true;
        $this->addColumn('idaclnota', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idnota', 'int', 0, 0, 'nota', 'Nota');
        $this->addColumn('aclnota', 'varchar', 200, 0, 0, "Titulo");
        $this->addColumn('intro', 'text', 0, 0, 0, "Intro");
        $this->addColumn('texto', 'text', 0, 0, 0, "Texto");
    }
}
class relacionadonotaTable extends Table
{
    function relacionadonotaTable()
    {
        $this->Table('relacionadonota');
        $this->title = 'Relacionados';
        $this->order = 'idrelacionadonota';
        $this->key = 'idrelacionadonota';
        $this->maxcols = 8;
        $this->is_detail = true;
        $this->addColumn('idrelacionadonota', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idnota', 'int', 0, 0, 0, 'Articulo');
        $this->addColumn('tipo', 'varchar', 7, 0, 0, "Tipo");
        $this->addColumn('relacionadonota', 'varchar', 255, 0, 0, 'Etiqueta');
        $this->addColumn('enlace', 'varchar', 500, 0, 0, "Enlace");
    }
}
class seccionTable extends Table
{
    function seccionTable()
    {
        $this->Table('seccion');
        $this->title = 'Secciones del Periodico';
        $this->order = 'orden';
        $this->key = 'idseccion';
        $this->maxcols = 6;
        $this->maxrows = 10;
        $this->addColumn('idseccion', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('seccion', 'varchar', 50, 0, 0, '<span class="required">Título*</span>');
        $this->addColumn('uri', 'varchar', 32, 0, 0, '<span class="required">URI*</span>', array(
            'source' => 'seccion',
            'apply_funct_js' => 'friendly_url'
        ));
        $this->addColumn('activo', 'bool', 0, 0, 0, '<span class="required">Estado</span>');
        $this->addColumn('orden', 'order', 0, 0, 0, 'Orden');
        $this->addColumn('menu', 'bool', 0, 0, 0, 'Menu?');
        $this->addColumn('menu_v2', 'bool', 0, 0, 0, 'Menu version 2');
        $this->addColumn('otras', 'bool', 0, 0, 0, 'Otras secciones');
        $this->addColumn('correo', 'varchar', 120, 0, 0, '<span class="required">Correo*</span>');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class edicionTable extends Table
{
    function edicionTable()
    {
        $this->Table('edicion');
        $this->title = 'Datos de Edición';
        $this->order = 'edicion DESC';
        $this->key = 'idedicion';
        $this->addColumn('idedicion', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('edicion', 'date', 0, 0, 0, 'Fecha Publicacion');
        $this->addColumn('estado', 'char', 1, 0, 0, 'Estado', array(
            'arr_values' => array(
                'A' => 'Publicad@',
                'D' => 'Borrador',
                'P' => 'Pendiente a Revisión',
                'R' => 'Pre-Publicacion'
            )
        ));
        $this->addColumn('numero', 'int', 0, 0, 0, 'Edición No.');
        $this->addColumn('portada', 'image', 0, 0, 0, '<span class="required">Portada*</span>', array(
            'sizes' => '245x113x1,150x150x1,109x110x1,70x110x1'
        ));
        $this->addColumn('pdf', 'file', 0, 0, 0, '<span class="required">Portada-PDF*</span>');
        $this->addColumn('paginas', 'int', 0, 0, 0, '<span class="required">No. Páginas*</span>');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('w_unit', 'auto', 0, 0, 0, 'Unidad');
        $this->addColumn('w_temp', 'auto', 0, 0, 0, 'Temperatura');
        $this->addColumn('w_icon', 'auto', 0, 0, 0, 'Icono');
        $this->addColumn('w_url', 'auto', 0, 0, 0, 'URL');
        $this->addColumn('show_live_broadcast', 'bool', 0, 0, 0, 'LiveStream');
        $this->addColumn('show_specials', 'int', 0, 0, 0, 'LiveStream Especiales');
        $this->addColumn('livestream_embed', 'xhtml', 0, 0, 0, 'LiveStream Embed', array(
            'style' => 'width:700px;height:300px;'
        ));
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class noticiaTable extends Table
{
    function noticiaTable()
    {
        $this->Table('noticia');
        $this->title = 'Noticias';
        $this->order = 'orden DESC,ultimahora DESC,hora DESC,creacion DESC';
        $this->key = 'idnoticia';
        $this->maxcols = 8;
        $this->maxrows = 10;
        $this->detail = 'credito';
        $this->cache = array(
            strftime("%Y|%m|%d", strtotime($_SESSION['edicion']['edicion'])) . '|noticia-[uri]-',
            strftime("%Y|%m|%d", strtotime($_SESSION['edicion']['edicion'])) . '|comentarios|'
        );
        $this->addColumn('idnoticia', 'serial', 0, 1, 0, 'Id');
        if(ADMIN !== true)
            $this->addColumn('idedicion', 'auto', 0, 0, 'edicion', 'Edición', array(
                'default' => $_SESSION['edicion']['idedicion']
            ));
        else
            $this->addColumn('idedicion', 'auto', 0, 0, 0, 'Edición', array(
                'default' => $_SESSION['edicion']['idedicion']
            ));
        $this->addColumn('idseccion', 'int', 0, 0, 'seccion', '<span class="required">Sección*</span>');
        $this->addColumn('iddepto', 'varchar', 35, 0, 'depto', 'Departamento');
        $this->addColumn('antetitulo', 'varchar', 100, 0, 0, 'Antetitulo');
        $this->addColumn('noticia', 'varchar', 255, 0, 0, '<span class="required">Titulo*</span>');
        $this->addColumn('subtitulo', 'varchar', 100, 0, 0, 'Subtitulo');
        $this->addColumn('ubicacion', 'char', 1, 0, 0, 'Ubicacion', array(
            'arr_values' => array(
                'D' => 'Derecha',
                'I' => 'Izquierda',
                'R' => 'Recuadro Portada',
                'C' => 'Columna del dia',
                'H' => 'Hablames del Idioma',
                'A' => 'Cartas al Director',
                'E' => 'Editorial'
            )
        ));
        $this->addColumn('intro', 'text', 0, 0, 0, 'Intro');
        $this->addColumn('resumen', 'text', 0, 0, 0, 'Resumen');
        $this->addColumn('texto', 'xhtml', 0, 0, 0, '<span class="required">Texto*</span>', array(
            'style' => 'width:700px;height:300px;'
        ));
        $this->addColumn('ultimahora', 'bool', 0, 0, 0, 'Últim Hora?');
        $this->addColumn('claves', 'varchar', 255, 0, 0, 'Etiquetas', array(
            'autocomplete' => true,
            'autocomplete_tb' => 'clave'
        ));
        $this->addColumn('estado', 'varchar', 1, 0, 0, 'Estado', array(
            'arr_values' => array(
                'A' => 'Publicad@',
                'D' => 'Borrador',
                'P' => 'Pendiente a Revisión'
            )
        ));
        $this->addColumn('orden', 'int', 0, 0, 0, 'Orden');
        $this->addColumn('hora', 'time', 0, 0, 0, 'Hora de Publicacion');
        $this->addColumn('destacado', 'bool', 0, 0, 0, 'Destacado?');
        $this->addColumn('en_boletin', 'bool', 0, 0, 0, 'Incluir en Boletin?');
        $this->addColumn('presentar', 'varchar', 1, 0, 0, 'Presentar');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'na_usuario.usuario',
            'readonly' => true
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
        $this->addColumn('seccion.uri', 'external');
        if(ADMIN !== true)
        {
            $this->addColumn('(SELECT count(idcomentario) FROM comentario WHERE idnoticia=noticia.idnoticia AND estado=\'A\') AS comentarios', 'external');
            $this->addColumn('raiting_1', 'auto', 0, 0, 0, 'Raiting 1');
            $this->addColumn('raiting_2', 'auto', 0, 0, 0, 'Raiting 2');
            $this->addColumn('raiting_3', 'auto', 0, 0, 0, 'Raiting 3');
            $this->addColumn('raiting_4', 'auto', 0, 0, 0, 'Raiting 4');
            $this->addColumn('raiting_5', 'auto', 0, 0, 0, 'Raiting 5');
        }
    }
}
class creditoTable extends Table
{
    function creditoTable()
    {
        $this->Table('credito');
        $this->title = 'Credito';
        $this->order = 'idcredito';
        $this->key = 'idcredito';
        $this->maxcols = 8;
        $this->is_detail = true;
        $this->addColumn('idcredito', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idnoticia', 'int', 0, 0, 0, 'Noticia');
        $this->addColumn('idautor', 'int', 0, 0, 'autor', '<span class="required">Autor*</span>');
    }
}
class creditonotaTable extends Table
{
    function creditonotaTable()
    {
        $this->Table('creditonota');
        $this->title = 'Credito';
        $this->order = 'idcreditonota';
        $this->key = 'idcreditonota';
        $this->maxcols = 8;
        $this->is_detail = true;
        $this->addColumn('idcreditonota', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idnota', 'int', 0, 0, 0, 'Noticia');
        $this->addColumn('idautor', 'int', 0, 0, 'autor', '<span class="required">Autor*</span>');
    }
}
class relacionadoTable extends Table
{
    function relacionadoTable()
    {
        $this->Table('relacionado');
        $this->title = 'Relacionados';
        $this->order = 'idrelacionado';
        $this->key = 'idrelacionado';
        $this->maxcols = 8;
        $this->is_detail = true;
        $this->addColumn('idrelacionado', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idnoticia', 'int', 0, 0, 0, 'Noticia');
        $this->addColumn('tipo', 'varchar', 7, 0, 0, "Tipo");
        $this->addColumn('relacionado', 'varchar', 255, 0, 0, 'Etiqueta');
        $this->addColumn('enlace', 'varchar', 500, 0, 0, "Enlace");
    }
}
class aclTable extends Table
{
    function aclTable()
    {
        $this->Table('acl');
        $this->title = 'Sidebar';
        $this->order = 'idacl';
        $this->key = 'idacl';
        $this->maxcols = 8;
        $this->is_detail = true;
        $this->addColumn('idacl', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idnoticia', 'int', 0, 0, 0, 'Noticia');
        $this->addColumn('acl', 'varchar', 200, 0, 0, "Titulo");
        $this->addColumn('intro', 'text', 0, 0, 0, "Intro");
        $this->addColumn('texto', 'text', 0, 0, 0, "Texto");
    }
}
class comentarioTable extends Table
{
    function comentarioTable()
    {
        $this->Table('comentario');
        $this->title = 'Comentarios';
        $this->order = 'creacion DESC';
        $this->key = 'idcomentario';
        $this->maxrows = 5;
        $this->addColumn('idcomentario', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idnoticia', 'int', 0, 0, 'noticia', 'Noticia', array(
            'readonly' => true
        ));
        $this->addColumn('nombre', 'varchar', 50, 0, 0, 'Nombre');
        $this->addColumn('email', 'varchar', 50, 0, 0, 'Email');
        $this->addColumn('web', 'varchar', 300, 0, 0, 'Página Web');
        $this->addColumn('comentario', 'text', 0, 0, 0, 'Texto');
        $this->addColumn('estado', 'varchar', 0, 0, 0, 'Estado', array(
            'arr_values' => array(
                'P' => 'en Revisión',
                'B' => 'Bloqueado',
                'A' => 'Aprobado'
            )
        ));
        if(ADMIN !== true)
            $this->addColumn('idusuario', 'int', 0, 0, 'usuario', 'Usuario', array(
                'readonly' => true
            ));
        $this->addColumn('ip', 'auto', 0, 0, 0, 'IP', array(
            'default' => $_SERVER['HTTP_X_FORWARDED_FOR']
        ));
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('noticia.idseccion', 'external');
    }
}
class usuarioTable extends Table
{
    function usuarioTable()
    {
        $this->Table('usuario');
        $this->title = 'Usuarios';
        $this->order = 'usuario, creacion DESC';
        $this->key = 'idusuario';
        $this->addColumn('idusuario', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('usuario', 'varchar', 50, 0, 0, 'Nick');
        $this->addColumn('clave', 'password', 0, 0, 0, 'Clave');
        $this->addColumn('nombre', 'varchar', 60, 0, 0, 'Nombre');
        $this->addColumn('apellido', 'varchar', 60, 0, 0, 'Apellidos');
        $this->addColumn('correo', 'varchar', 50, 0, 0, 'Correo');
        $this->addColumn('activo', 'bool', 0, 0, 0, 'Activo?');
        $this->addColumn('suscriptor', 'bool', 0, 0, 0, 'Suscrito?');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('telefono', 'varchar', 8, 0, 0, 'Telefono');
        $this->addColumn('departamento', 'varchar', 30, 0, 0, 'Departamento');
        $this->addColumn('direccion', 'varchar', 500, 0, 0, 'Direccion');
        $this->addColumn('periodosuscripcion', 'varchar', 22, 0, 0, 'Periodo suscripcion');
        $this->addColumn('lista', 'bool', 0, 0, 0, 'Suscrito en la lista?');
        $this->addColumn('openid', 'varchar', 255, 0, 0, 'OpenId');
        $this->addColumn('openidurl', 'varchar', 255, 0, 0, 'OpenId URL');
    }
}
class ratingTable extends Table
{
    function ratingTable()
    {
        $this->Table('rating');
        $this->title = 'Rating';
        $this->order = 'idrating DESc';
        $this->key = 'idrating';
        $this->addColumn('idrating', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idarticulo', 'int', 0, 0, 'articulo', 'Articulo');
        $this->addColumn('idnoticia', 'int', 0, 0, 'noticia', 'Noticia');
        $this->addColumn('idnota', 'int', 0, 0, 'nota', 'Nota');
        $this->addColumn('leido', 'int', 0, 0, 0, 'Leido');
        $this->addColumn('envido', 'int', 0, 0, 0, 'Enviado');
    }
}
class encuestaTable extends Table
{
    function encuestaTable()
    {
        $this->Table('encuesta');
        $this->title = 'Encuestas';
        $this->order = 'idencuesta DESC';
        $this->key = 'idencuesta';
        $this->detail = 'opcion';
        $this->addColumn('idencuesta', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('encuesta', 'varchar', 300, 0, 0, '<span class="required">Pregunta*</span>');
        $this->addColumn('fecha_ini', 'datetime', 0, 0, 0, '<span class="required">Fecha de Apertura*</span>');
        $this->addColumn('fecha_fin', 'datetime', 0, 0, 0, '<span class="required">Fecha de Cierre*</span>');
        $this->addColumn('cerrada', 'bool', 0, 0, 0, 'Cerrar?');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
        $this->addColumn('(SELECT SUM(resultado) FROM opcion WHERE opcion.idencuesta=encuesta.idencuesta) AS votos', 'external');
    }
}
class opcionTable extends Table
{
    function opcionTable()
    {
        $this->Table('opcion');
        $this->title = 'Opciones';
        $this->key = 'idopcion';
        $this->order = 'resultado DESC';
        $this->is_detail = true;
        $this->addColumn('idopcion', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idencuesta', 'int', 0, 0, 'encuesta', 'Encuesta', array(
            'preset' => true
        ));
        $this->addColumn('opcion', 'varchar', 100, 0, 0, 'Opcion');
        $this->addColumn('resultado', 'auto', 0, 0, 0, 'Resultado');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class encuesta_logTable extends Table
{
    function encuesta_logTable()
    {
        $this->Table('encuesta_log');
        $this->title = 'Logs Encuestas';
        $this->order = 'idencuesta_log DESc';
        $this->key = 'idencuesta_log';
        $this->addColumn('idencuesta_log', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idencuesta', 'int', 0, 0, 'encuesta', 'Encuesta');
        $this->addColumn('fecha', 'auto', 0, 0, 0, 'Fecha');
        $this->addColumn('ip', 'varchar', 15, 0, 0, 'IP');
        $this->addColumn('agent', 'varchar', 500, 0, 0, 'Agente');
    }
}
class disciplinaTable extends Table
{
    function disciplinaTable()
    {
        $this->Table('disciplina');
        $this->title = 'Disciplinas';
        $this->order = 'disciplina';
        $this->key = 'iddisciplina';
        $this->addColumn('iddisciplina', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('disciplina', 'varchar', 60, 0, 0, '<span class="required">Nombre*</span>');
    }
}
class equipoTable extends Table
{
    function equipoTable()
    {
        $this->Table('equipo');
        $this->title = 'Equipos';
        $this->order = 'idequipo';
        $this->key = 'idequipo';
        $this->addColumn('idequipo', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('equipo', 'varchar', 50, 0, 0, '<span class="required">Nombre/Club*</span>');
        $this->addColumn('iddisciplina', 'int', 0, 0, 'disciplina', 'Disciplina');
        $this->addColumn('logo', 'image', 0, 0, 0, 'Logo/Bandera');
        $this->addColumn('usuario', 'auth_user', 0, 0, 0, 'Creado por:');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
    }
}
class jornadaTable extends Table
{
    function jornadaTable()
    {
        $this->Table('jornada');
        $this->title = 'Jornada';
        $this->order = 'fecha DESC';
        $this->key = 'idjornada';
        $this->addColumn('idjornada', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('jornada', 'varchar', 50, 0, 0, '<span class="required">Nombre*</span>');
        $this->addColumn('fecha', 'datetime', 0, 0, 0, 'Fecha');
        $this->addColumn('fecha_ini', 'datetime', 0, 0, 0, '<span class="required">Mostrar desde*</span>');
        $this->addColumn('fecha_fin', 'datetime', 0, 0, 0, '<span class="required">Hasta*</span>');
        $this->addColumn('usuario', 'auth_user', 0, 0, 0, 'Creado por:');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
    }
}
class partidoTable extends Table
{
    function partidoTable()
    {
        $this->Table('partido');
        $this->title = 'Partidos';
        $this->order = 'orden';
        $this->key = 'idpartido';
        $this->addColumn('idpartido', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idjornada', 'int', 0, 0, 'jornada', '<span class="required">Jornada*</span>');
        $this->addColumn('partido', 'varchar', 50, 0, 0, 'Título (opcional)');
        $this->addColumn('hora', 'time', 0, 0, 0, '<span class="required">Hora*</span>');
        $this->addColumn('orden', 'order', 0, 0, 0, 'Orden');
        $this->addColumn('usuario', 'auth_user', 0, 0, 0, 'Creado por:');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
    }
}
class marcadorTable extends Table
{
    function marcadorTable()
    {
        $this->Table('marcador');
        $this->title = 'Marcador';
        $this->key = 'idmarcador';
        $this->order = 'fecha DESC,idmarcador DESC';
        $this->addColumn('idmarcador', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('marcador', 'varchar', 500, 0, 0, 'Descripcion');
        $this->addColumn('equipo1', 'varchar', 500, 0, 0, 'Equipo1');
        $this->addColumn('bandera1', 'image', 0, 0, 0, 'Bandera equipo1', array(
            'sizes' => '55x55,150x150,33x19'
        ));
        $this->addColumn('valor1', 'varchar', 10, 0, 0, 'Puntaje equipo1');
        $this->addColumn('equipo2', 'varchar', 500, 0, 0, 'Equipo2');
        $this->addColumn('bandera2', 'image', 0, 0, 0, 'Bandera equipo2', array(
            'sizes' => '55x55,150x150,33x19'
        ));
        $this->addColumn('valor2', 'varchar', 10, 0, 0, 'Puntaje equipo2');
        $this->addColumn('fecha', 'date', 0, 0, 0, 'Fecha');
        $this->addColumn('activo', 'bool', 0, 0, 0, 'Activo');
        $this->addColumn('fondo', 'image', 0, 0, 0, 'Fondo', array(
            'sizes' => '55x55,150x150,298x121'
        ));
        $this->addColumn('bolita', 'varchar', 200, 0, 0, 'Tipo de Deporte');
        $this->addColumn('extra', 'varchar', 200, 0, 0, 'Extra');
    }
}
class dolarTable extends Table
{
    function dolarTable()
    {
        $this->Table('dolar');
        $this->title = 'Tasas de Cambio';
        $this->order = 'iddolar DESC';
        $this->key = 'iddolar';
        $this->maxrows = 10;
        $this->addColumn('iddolar', 'date', 0, 1, 0, 'Fecha');
        $this->addColumn('oficial', 'numeric', 0, 0, 0, '<span class="required">Oficial*</span>');
        $this->addColumn('pcompra', 'numeric', 0, 0, 0, 'Paralelo-Compra');
        $this->addColumn('pventa', 'numeric', 0, 0, 0, 'Paralelo-Venta');
        $this->addColumn('ncompra', 'numeric', 0, 0, 0, 'Negro-Compra');
        $this->addColumn('nventa', 'numeric', 0, 0, 0, 'Negro-Venta');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'na_usuario.usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class paisTable extends Table
{
    function paisTable()
    {
        $this->Table('pais');
        $this->title = 'Paises para el Dolar';
        $this->order = 'orden';
        $this->key = 'idpais';
        $this->addColumn('idpais', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('pais', 'varchar', 32, 0, 0, '<span class="required">País*</span>');
        $this->addColumn('idmoneda', 'int', 0, 0, 'moneda', '<span class="required">Moneda*</span>');
        $this->addColumn('bandera', 'image', 0, 0, 0, 'Bandera', array(
            'sizes' => '17x9'
        ));
        $this->addColumn('orden', 'order', 0, 0, 0, 'Orden');
        $this->addColumn('usuario', 'auth_user', 0, 0, 0, 'Creado por:');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
    }
}
class dolarpaisTable extends Table
{
    function dolarpaisTable()
    {
        $this->Table('dolarpais');
        $this->title = 'Dolar En Otros Paises';
        $this->order = 'iddolarpais';
        $this->key = 'iddolarpais';
        $this->maxrows = 10;
        $this->addColumn('iddolarpais', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idedicion', 'auto', 0, 0, 'edicion', 'Edición', array(
            'default' => $_SESSION['edicion']['idedicion']
        ));
        $this->addColumn('idpais', 'int', 0, 0, 'pais', '<span class="required">País*</span>');
        $this->addColumn('compra', 'numeric', 2, 0, 0, '<span class="required">Compra*</span>');
        $this->addColumn('venta', 'numeric', 2, 0, 0, '<span class="required">Venta*</span>');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'na_usuario.usuario'
        ));
        $this->addColumn('pais.bandera', 'external');
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
        $this->addColumn('(SELECT abr FROM moneda WHERE pais.idmoneda=moneda.idmoneda) AS abr', 'external');
    }
}
class unidadTable extends Table
{
    function unidadTable()
    {
        $this->Table('unidad');
        $this->title = 'Unidad de Medida';
        $this->order = 'idunidad';
        $this->key = 'idunidad';
        $this->addColumn('idunidad', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('unidad', 'varchar', 32, 0, 0, '<span class="required">Unidad*</span>');
        $this->addColumn('abr', 'varchar', 6, 0, 0, '<span class="required">Abreviatura*</span>');
        $this->addColumn('usuario', 'auth_user', 0, 0, 0, 'Creado por:');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
    }
}
class monedaTable extends Table
{
    function monedaTable()
    {
        $this->Table('moneda');
        $this->title = 'Moneda';
        $this->order = 'idmoneda';
        $this->key = 'idmoneda';
        $this->addColumn('idmoneda', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('moneda', 'varchar', 32, 0, 0, '<span class="required">Unidad*</span>');
        $this->addColumn('abr', 'varchar', 6, 0, 0, '<span class="required">Abreviatura*</span>');
        $this->addColumn('usuario', 'auth_user', 0, 0, 0, 'Creado por:');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
    }
}
class productoTable extends Table
{
    function productoTable()
    {
        $this->Table('producto');
        $this->title = 'Productos';
        $this->order = 'orden';
        $this->key = 'idproducto';
        $this->addColumn('idproducto', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('producto', 'varchar', 50, 0, 0, '<span class="required">Nombre*</span>');
        $this->addColumn('unidad', 'varchar', 24, 0, 0, '<span class="required">Unidad*</span>');
        $this->addColumn('moneda', 'varchar', 24, 0, 0, '<span class="required">Moneda de Compra*</span>');
        $this->addColumn('orden', 'order', 0, 0, 0, 'Orden');
        $this->addColumn('usuario', 'auth_user', 0, 0, 0, 'Creado por:');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
    }
}
class comportamientoTable extends Table
{
    function comportamientoTable()
    {
        $this->Table('comportamiento');
        $this->title = 'Comportamiento de Productos';
        $this->order = 'fecha DESC';
        $this->key = 'idcomportamiento';
        $this->addColumn('idcomportamiento', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idproducto', 'int', 0, 0, 'producto', '<span class="required">Producto*</span>');
        $this->addColumn('comportamiento', 'numeric', 2, 0, 0, '<span class="required">Precio*</span>');
        $this->addColumn('fecha', 'date', 0, 0, 0, 'Fecha:');
        $this->addColumn('usuario', 'auth_user', 0, 0, 0, 'Creado por:');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('producto.moneda', 'external');
        $this->addColumn('producto.unidad', 'external');
    }
}
class claveTable extends Table
{
    function claveTable()
    {
        $this->Table('clave');
        $this->title = 'Claves';
        $this->order = 'clave,idclave';
        $this->key = 'idclave';
        $this->addColumn('idclave', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('clave', 'varchar', 255, 0, 0, '<span class="required">Clave*</span>');
    }
}
class carteleraTable extends Table
{
    function carteleraTable()
    {
        $this->Table('cartelera');
        $this->title = 'Cartelera';
        $this->order = 'fecha_ini DESC, idcartelera DESC';
        $this->key = 'idcartelera';
        $this->addColumn('idcartelera', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('fecha_ini', 'datetime', 0, 0, 0, '<span class="required">Fecha de Inicio*</span>');
        $this->addColumn('fecha_fin', 'datetime', 0, 0, 0, '<span class="required">Fecha de Finalizacion*</span>');
        $this->addColumn('cartelera', 'image', 0, 0, 0, 'Imagen para portada', array(
            'sizes' => '150x150,390x272x1,370x258x1,544x220x1'
        ));
        $this->addColumn('original', 'image', 0, 0, 0, 'Imagen original', array(
            'sizes' => '150x150,640x200x1,600x400,397x200x1'
        ));
        $this->addColumn('estado', 'char', 1, 0, 0, 'Estado');
        $this->addColumn('titulo', 'varchar', 250, 0, 0, 'Titulo');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class signoTable extends Table
{
    function signoTable()
    {
        $this->Table('signo');
        $this->title = 'Signo';
        $this->order = 'idsigno';
        $this->key = 'idsigno';
        $this->maxrows = 10;
        $this->addColumn('idsigno', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('signo', 'varchar', 32, 0, 0, '<span class="required">Signo*</span>');
        $this->addColumn('imagen', 'image', 0, 0, 0, 'Imagen', array(
            'sizes' => '55x55,150x150'
        ));
        $this->addColumn('fecha_ini', 'date', 0, 0, 0, 'Desde');
        $this->addColumn('fecha_fin', 'date', 0, 0, 0, 'Hasta');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class horoscopoTable extends Table
{
    function horoscopoTable()
    {
        $this->Table('horoscopo');
        $this->title = 'Horoscopo';
        $this->order = 'idhoroscopo';
        $this->key = 'idhoroscopo';
        $this->maxrows = 10;
        $this->addColumn('idhoroscopo', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idedicion', 'auto', 0, 0, 'edicion', 'Edición', array(
            'default' => $_SESSION['edicion']['idedicion']
        ));
        $this->addColumn('idsigno', 'int', 0, 0, 'signo', '<span class="required">Signo*</span>');
        $this->addColumn('horoscopo', 'xhtml', 0, 0, 0, '<span class="required">Adivinación</span>');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class paginaTable extends Table
{
    function paginaTable()
    {
        $this->Table('pagina');
        $this->key = 'idpagina';
        $this->title = 'Paginas';
        $this->maxrows = 20;
        $this->order = 'uri';
        $this->cache = array(
            "pages|[uri]"
        );
        $this->addColumn('idpagina', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('pagina', 'varchar', 500, 0, 0, '<span class="required">Titulo*</span>');
        $this->addColumn('uri', 'varchar', 32, 1, 0, '<span class="required">Id/URI*</span>', array(
            'source' => 'pagina',
            'apply_funct_js' => 'friendly_url'
        ));
        $this->addColumn('texto', 'xhtml', 0, 0, 0, '<span class="required">Texto*</span>');
        $this->addColumn('estado', 'char', 1, 0, 0, 'Estado');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class filtroTable extends Table
{
    function filtroTable()
    {
        $this->Table('filtro');
        $this->key = 'idfiltro';
        $this->title = 'Malas Palabras';
        $this->order = 'filtro';
        $this->maxrows = 40;
        $this->addColumn('idfiltro', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('filtro', 'varchar', 80, 0, 0, '<span class="required">Palabra*</span>');
        $this->addColumn('peso', 'int', 0, 0, 0, 'Peso(0-100)');
        $this->addColumn('usuario', 'auth_user', 0, 0, 0, 'Usuario');
        $this->addColumn('fecha', 'auto', 0, 0, 0, 'Agregada');
    }
}
class anuncioTable extends Table
{
    function anuncioTable()
    {
        $this->Table('anuncio');
        $this->key = 'idanuncio';
        $this->title = 'Anuncios';
        $this->order = 'idanuncio';
        $this->maxrows = 40;
        $this->addColumn('idanuncio', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idseccion', 'int', 0, 0, 'seccion', 'Sección');
        $this->addColumn('idseccionsuplemento', 'int', 0, 0, 'seccionsuplemento', 'Sección Suplemento');
        $this->addColumn('posicion', 'int', 0, 0, 0, 'Ubicacion', array(
            'arr_values' => array(
                1 => 'LandScape arriba'
            )
        ));
        $this->addColumn('zona', 'int', 0, 0, 0, 'ID Zona');
    }
}
class na_usuarioTable extends Table
{
    function na_usuarioTable()
    {
        $this->Table('na_usuario');
        $this->key = 'idusuario';
        $this->title = 'Usuarios';
        $this->maxrows = 15;
        $this->order = 'usuario';
        $this->addColumn('idusuario', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('usuario', 'varchar', 48, 0, 0, 'Usuario');
        $this->addColumn('passwd', 'password', 32, 0, 0, 'Password');
        $this->addColumn('inactivo', 'bool', 0, 0, 0, 'Inactivo');
        $this->addColumn('rol', 'varchar', 12, 0, 0, 'Rol');
        $this->addColumn('nombre', 'varchar', 60, 0, 0, 'Nombre');
        $this->addColumn('apellido', 'varchar', 60, 0, 0, 'Apellido');
        $this->addColumn('email', 'varchar', 100, 0, 0, 'Correo');
        $this->addColumn('descripcion', 'text', 0, 0, 0, 'Descripción');
        $this->addColumn('registrado', 'auto', 0, 0, 0, 'Fecha de Registro');
    }
}
class caricaturaTable extends Table
{
    function caricaturaTable()
    {
        $this->Table('caricatura');
        $this->title = 'Caricatura';
        $this->order = 'orden';
        $this->key = 'idcaricatura';
        $this->maxcols = 8;
        $this->maxrows = 10;
        $this->addColumn('idcaricatura', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idedicion', 'auto', 0, 0, 'edicion', 'Edición', array(
            'default' => $_SESSION['edicion']['idedicion']
        ));
        $this->addColumn('caricatura', 'image', 0, 0, 0, 'Caricatura', array(
            'sizes' => '150x150,390x272x1,404,600x450,650x470'
        ));
        $this->addColumn('descripcion', 'text', 0, 0, 0, 'Descripcion');
        $this->addColumn('orden', 'order', 0, 0, 0, 'Orden');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha de Registro');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'na_usuario.usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
        $this->addColumn('(SELECT count(idcomentariocaricatura) FROM comentariocaricatura WHERE idcaricatura=caricatura.idcaricatura) AS comentarios', 'external');
    }
}
class deptoTable extends Table
{
    function deptoTable()
    {
        $this->Table('depto');
        $this->key = 'iddepto';
        $this->title = 'Departamentos';
        $this->order = 'iddepto';
        $this->addColumn('iddepto', 'varchar', 35, 1, 0, 'Id');
        $this->addColumn('depto', 'varchar', 150, 0, 0, 'Departamento');
    }
}
class tipo_clasificadoTable extends Table
{
    function tipo_clasificadoTable()
    {
        $this->Table('tipo_clasificado');
        $this->key = 'idtipo_clasificado';
        $this->title = 'Tipos de Clasificados';
        $this->order = 'idtipo_clasificado';
        $this->addColumn('idtipo_clasificado', 'varchar', 50, 1, 0, 'Id');
        $this->addColumn('tipo_clasificado', 'varchar', 50, 0, 0, 'Tipo');
        $this->addColumn('imagen', 'image', 0, 0, 0, 'Imagen-Seccion');
    }
}
class subtipo_clasificadoTable extends Table
{
    function subtipo_clasificadoTable()
    {
        $this->Table('subtipo_clasificado');
        $this->key = 'idsubtipo_clasificado';
        $this->title = 'SubTipo de Clasificados';
        $this->order = 'idsubtipo_clasificado';
        $this->addColumn('idsubtipo_clasificado', 'int', 0, 1, 0, 'Id');
        $this->addColumn('subtipo_clasificado', 'varchar', 200, 0, 0, 'Tipo');
        $this->addColumn('idtipo_clasificado', 'varchar', 50, 1, 'tipo_clasificado', 'Id');
    }
}
class rubroTable extends Table
{
    function rubroTable()
    {
        $this->Table('rubro');
        $this->key = 'rubro';
        $this->title = 'Rubros';
        $this->order = 'idrubro';
        $this->addColumn('idrubro', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('rubro', 'varchar', 150, 0, 0, 'Rubro');
        $this->addColumn('idtipo_clasificado', 'varchar', 50, 0, 'tipo_clasificado', 'Tipo');
        $this->addColumn('idsubtipo_clasificado', 'int', 0, 0, 'subtipo_clasificado', 'SubTipo');
    }
}
class ca_usuarioTable extends Table
{
    function ca_usuarioTable()
    {
        $this->Table('ca_usuario');
        $this->key = 'idca_usuario';
        $this->title = 'Usuarios Clasificados';
        $this->order = 'idca_usuario';
        $this->addColumn('idca_usuario', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('ca_usuario', 'varchar', 50, 0, 0, 'Usuario');
        $this->addColumn('ca_nombre', 'varchar', 200, 0, 0, 'Nombre');
        $this->addColumn('ca_apellido', 'varchar', 200, 0, 0, 'Apellido');
        $this->addColumn('ca_correo', 'varchar', 80, 0, 0, 'Correo');
        $this->addColumn('ca_telefono', 'varchar', 40, 0, 0, 'Telefono');
        $this->addColumn('ca_celular', 'varchar', 30, 0, 0, 'Celular');
        $this->addColumn('ca_direccion', 'varchar', 600, 0, 0, 'Direccion');
        $this->addColumn('ca_curriculum', 'file', 0, 0, 0, 'curriculum');
    }
}
class clasificadoTable extends Table
{
    function clasificadoTable()
    {
        $this->Table('clasificado');
        $this->key = 'idclasificado';
        $this->title = 'Clasificados';
        $this->order = 'idclasificado';
        $this->maxrows = 10;
        $this->addColumn('idclasificado', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('iddepto', 'varchar', 35, 0, 'depto', 'Departamento');
        $this->addColumn('idrubro', 'int', 0, 0, 'rubro', 'Rubro');
        $this->addColumn('clasificado', 'varchar', 500, 0, 0, 'Titulo');
        $this->addColumn('detalle', 'text', 0, 0, 0, 'Detalles');
        $this->addColumn('descripcion', 'text', 0, 0, 0, 'Descripcion');
        $this->addColumn('imagenp', 'image', 0, 0, 0, 'Imagen principal');
        $this->addColumn('archivo', 'file', 0, 0, 0, 'Archivo');
        $this->addColumn('destacado', 'bool', 0, 0, 0, 'Destacado');
        $this->addColumn('claves', 'varchar', 255, 0, 0, 'Etiquetas', array(
            'autocomplete' => true,
            'autocomplete_tb' => 'clave'
        ));
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idca_usuario', 'int', 0, 0, 'ca_usuario', 'Usuario', array(
            'display' => 'ca_usuario.ca_usuario'
        ));
        $this->addColumn('ca_usuario.ca_nombre', 'external');
        $this->addColumn('ca_usuario.ca_apellido', 'external');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'na_usuario.usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
        $this->addColumn('rubro.idtipo_clasificado', 'external');
    }
}
class imagen_clasificadoTable extends Table
{
    function imagen_clasificadoTable()
    {
        $this->Table('imagen_clasificado');
        $this->key = 'idimagen_clasificado';
        $this->title = 'Imagenes de Clasificados';
        $this->order = 'idimagen_clasificado';
        $this->addColumn('idimagen_clasificado', 'varchar', 50, 1, 0, 'Id');
        $this->addColumn('idclasificado', 'int', 0, 0, 'clasificado', 'Clasificado');
        $this->addColumn('imagen_clasificado', 'image', 0, 0, 0, 'Imagen');
        $this->addColumn('descripcion', 'text', 0, 0, 0, 'Descripcion');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idca_usuario', 'int', 0, 0, 'ca_usuario', 'Usuario Publico', array(
            'display' => 'ca_usuario.ca_usuario'
        ));
        $this->addColumn('ca_usuario.nombre', 'external');
        $this->addColumn('ca_usuario.apellido', 'external');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario Administrativo', array(
            'display' => 'na_usuario.usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class video_clasificadoTable extends Table
{
    function video_clasificadoTable()
    {
        $this->Table('video_clasificado');
        $this->key = 'idvideo_clasificado';
        $this->title = 'Videos de Clasificados';
        $this->order = 'idvideo_clasificado';
        $this->addColumn('idvideo_clasificado', 'varchar', 50, 1, 0, 'Id');
        $this->addColumn('idclasificado', 'int', 0, 0, 'clasificado', 'Clasificado');
        $this->addColumn('video_clasificado', 'varchar', 400, 0, 0, 'Titulo');
        $this->addColumn('descripcion', 'text', 0, 0, 0, 'Descripcion');
        $this->addColumn('url', 'video', 0, 0, 0, 'Video');
        $this->addColumn('preview', 'image', 0, 0, 0, 'Preview');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idca_usuario', 'int', 0, 0, 'ca_usuario', 'Usuario Publico', array(
            'display' => 'ca_usuario.ca_usuario'
        ));
        $this->addColumn('ca_usuario.nombre', 'external');
        $this->addColumn('ca_usuario.apellido', 'external');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario Administrativo', array(
            'display' => 'na_usuario.usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class suspaisTable extends Table
{
    function suspaisTable()
    {
        $this->Table('suspais');
        $this->key = 'idsuspais';
        $this->title = 'Paises';
        $this->order = 'idsuspais';
        $this->addColumn('idsuspais', 'varchar', 2, 1, 0, 'Id');
        $this->addColumn('suspais', 'varchar', 200, 0, 0, 'Pais');
    }
}
class escolaridadTable extends Table
{
    function escolaridadTable()
    {
        $this->Table('escolaridad');
        $this->key = 'idescolaridad';
        $this->title = 'Escolaridad';
        $this->order = 'idsuspais';
        $this->addColumn('idescolaridad', 'int', 0, 1, 0, 'Id');
        $this->addColumn('escolaridad', 'varchar', 300, 0, 0, 'Escolaridad');
    }
}
class suscriptorTable extends Table
{
    function suscriptorTable()
    {
        $this->Table('suscriptor');
        $this->key = 'idsuscriptor';
        $this->title = 'Suscriptores';
        $this->order = 'idsuscriptor';
        $this->addColumn('idsuscriptor', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idusuario', 'serial', 0, 0, 'usuario', 'Usuario');
        $this->addColumn('fechanacimiento', 'date', 0, 0, 0, 'Fecha de nacimiento');
        $this->addColumn('idescolaridad', 'int', 0, 0, 'escolaridad', 'Escolaridad');
        $this->addColumn('idsuspais', 'int', 0, 0, 'suspais', 'Paises');
        $this->addColumn('sexo', 'bool', 0, 0, 0, 'Sexo');
        $this->addColumn('departamento', 'varchar', 200, 0, 0, 'Departamento');
        $this->addColumn('ciudad', 'varchar', 200, 0, 0, 'Ciudad');
        $this->addColumn('direccion', 'text', 0, 0, 0, 'Direccion');
        $this->addColumn('telefono', 'varchar', 20, 0, 0, 'Telefono');
        $this->addColumn('fax', 'varchar', 20, 0, 0, 'Fax');
        $this->addColumn('codigopostal', 'varchar', 20, 0, 0, 'Codigo postal');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idnausuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'na_usuario.usuario'
        ));
    }
}
class suscripcionTable extends Table
{
    function suscripcionTable()
    {
        $this->Table('suscripcion');
        $this->key = 'idsuscripcion';
        $this->title = 'Suscripcion';
        $this->order = 'creacion DESC';
        $this->addColumn('idsuscripcion', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idsuscriptor', 'int', 0, 0, 'suscriptor', 'Suscriptor');
        $this->addColumn('fechaini', 'date', 0, 0, 0, 'Fecha Inicio');
        $this->addColumn('fechafin', 'date', 0, 0, 0, 'Fecha Fin');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'na_usuario.usuario'
        ));
    }
}
class poradentroTable extends Table
{
    function poradentroTable()
    {
        $this->Table('poradentro');
        $this->key = 'idporadentro';
        $this->order = 'idporadentro DESC';
        $this->title = 'Por Adentro';
        $this->addColumn('idporadentro', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('poradentro', 'varchar', 300, 0, 0, 'Titulo');
        $this->addColumn('enlace', 'varchar', 500, 0, 0, 'Enlace');
        $this->addColumn('idimagen', 'int', 0, 0, 'imagen', 'Imagen', array(
            'readonly' => true
        ));
        $this->addColumn('estado', 'char', 1, 0, 0, 'Estado');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'na_usuario.usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class infografiaTable extends Table
{
    function infografiaTable()
    {
        $this->Table('infografia');
        $this->key = 'idinfografia';
        $this->order = 'creacion DESC';
        $this->title = 'InfoGrafia';
        $this->addColumn('idinfografia', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('infografia', 'varchar', 300, 0, 0, 'Titulo');
        $this->addColumn('imagen', 'image', 0, 0, 0, 'Imagen', array(
            'sizes' => '200x200'
        ));
        $this->addColumn('estado', 'char', 1, 0, 0, 'Estado');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'na_usuario.usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class domingoTable extends Table
{
    function domingoTable()
    {
        $this->Table('domingo');
        $this->key = 'iddomingo';
        $this->order = 'edicion DESC';
        $this->title = 'LaPrensa - Domingo';
        $this->addColumn('iddomingo', 'int', 0, 1, 0, 'Id');
        $this->addColumn('idedicion', 'auto', 0, 0, 'edicion', 'Edición', array(
            'default' => $_SESSION['edicion']['idedicion']
        ));
        $this->addColumn('domingo', 'image', 0, 0, 0, 'Preview');
        $this->addColumn('domingopdf', 'varchar', 500, 0, 0, 'Nombre PDF');
    }
}
class secciondomingoTable extends Table
{
    function secciondomingoTable()
    {
        $this->Table('secciondomingo');
        $this->key = 'idsecciondomingo';
        $this->order = 'orden';
        $this->title = 'Secciones';
        $this->maxrows = 15;
        $this->addColumn('idsecciondomingo', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('secciondomingo', 'varchar', 48, 0, 0, 'Sección');
        $this->addColumn('orden', 'order', 0, 0, 0, 'Orden');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'auto', 0, 0, 'na_usuario', 'Usuario', array(
            'default' => $_SESSION['usuario']['idusuario'],
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class seccionxdomingoTable extends Table
{
    function seccionxdomingoTable()
    {
        $this->Table('seccionxdomingo');
        $this->key = 'idseccionxdomingo';
        $this->order = 'iddomingo, pagina';
        $this->title = 'Esquema de Contenido';
        $this->cache = array(
            'domingo|' . strftime("%Y%m%d", strtotime($_SESSION['edicion']['edicion']))
        );
        $this->addColumn('idseccionxdomingo', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('iddomingo', 'auto', 0, 0, 'domingo', 'Domingo', array(
            'default' => $_SESSION['edicion']['domingo']['iddomingo']
        ));
        $this->addColumn('idsecciondomingo', 'int', 0, 0, 'secciondomingo', 'Sección');
        $this->addColumn('pagina', 'int', 0, 0, 0, '# Pagina');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'auto', 0, 0, 'na_usuario', 'Usuario', array(
            'default' => $_SESSION['usuario']['idusuario'],
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class paginaxdomingoTable extends Table
{
    function paginaxdomingoTable()
    {
        $this->Table('paginaxdomingo');
        $this->key = 'idpaginaxdomingo';
        $this->order = 'orden';
        $this->title = 'Paginas';
        $this->maxrows = 5;
        $this->cache = array(
            'domingo|' . strftime("%Y%m%d", strtotime($_SESSION['edicion']['edicion']))
        );
        $this->addColumn('idpaginaxdomingo', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('iddomingo', 'auto', 0, 0, 'domingo', 'Domingo', array(
            'default' => $_SESSION['edicion']['domingo']['iddomingo']
        ));
        $this->addColumn('paginaxdomingo', 'image', 0, 0, 0, 'Página', array(
            'sizes' => '48x48x1,150x150,448x490,1275x1394x1',
            'paths' => ',,/../public_html/domingo/pages/' . $_REQUEST['iddomingo'] . ',/../public_html/domingo/pages/' . $_REQUEST['iddomingo'] . '/large'
        ));
        $this->addColumn('orden', 'order', 0, 0, 0, 'Orden');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'auto', 0, 0, 'na_usuario', 'Usuario', array(
            'default' => $_SESSION['usuario']['idusuario'],
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class magazineTable extends Table
{
    function magazineTable()
    {
        $this->Table('magazine');
        $this->key = 'idmagazine';
        $this->order = 'edicion DESC';
        $this->title = 'Magazine';
        $this->maxrows = 10;
        $this->addColumn('idmagazine', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('magazine', 'date', 0, 0, 0, 'Fecha');
        $this->addColumn('edicion', 'int', 0, 0, 0, 'No. Edición');
        $this->addColumn('preview', 'image', 0, 0, 0, 'Preview', array(
            'sizes' => '228'
        ));
        $this->addColumn('magazinepdf', 'varchar', 500, 0, 0, 'Nombre PDF');
        $this->addColumn('estado', 'bool', 0, 0, 0, 'Publico?');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'auto', 0, 0, 'na_usuario', 'Usuario', array(
            'default' => $_SESSION['usuario']['idusuario'],
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class seccionmagazineTable extends Table
{
    function seccionmagazineTable()
    {
        $this->Table('seccionmagazine');
        $this->key = 'idseccionmagazine';
        $this->order = 'orden';
        $this->title = 'Secciones';
        $this->maxrows = 15;
        $this->addColumn('idseccionmagazine', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('seccionmagazine', 'varchar', 48, 0, 0, 'Sección');
        $this->addColumn('orden', 'order', 0, 0, 0, 'Orden');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'auto', 0, 0, 'na_usuario', 'Usuario', array(
            'default' => $_SESSION['usuario']['idusuario'],
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class seccionxmagazineTable extends Table
{
    function seccionxmagazineTable()
    {
        $this->Table('seccionxmagazine');
        $this->key = 'idseccionxmagazine';
        $this->order = 'magazine desc, pagina';
        $this->title = 'Esquema de Contenido';
        $this->addColumn('idseccionxmagazine', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idmagazine', 'int', 0, 0, 'magazine', 'Magazine');
        $this->addColumn('idseccionmagazine', 'int', 0, 0, 'seccionmagazine', 'Sección');
        $this->addColumn('pagina', 'int', 0, 0, 0, '# Pagina');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'auto', 0, 0, 'na_usuario', 'Usuario', array(
            'default' => $_SESSION['usuario']['idusuario'],
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class paginaxmagazineTable extends Table
{
    function paginaxmagazineTable()
    {
        $this->Table('paginaxmagazine');
        $this->key = 'idpaginaxmagazine';
        $this->order = 'orden';
        $this->title = 'Paginas';
        $this->maxrows = 5;
        $this->addColumn('idpaginaxmagazine', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idmagazine', 'int', 0, 0, 'magazine', 'Magazine');
        $this->addColumn('paginaxmagazine', 'image', 0, 0, 0, 'Página', array(
            'sizes' => '48x48x1,150x150,371x490,1100x1452x1',
            'paths' => ',,/../public_html/magazine/animada/pages/' . str_replace('-', '', $_REQUEST['magazine']) . ',/../public_html/magazine/animada/pages/' . str_replace('-', '', $_REQUEST['magazine']) . '/large'
        ));
        $this->addColumn('orden', 'order', 0, 0, 0, 'Orden');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'auto', 0, 0, 'na_usuario', 'Usuario', array(
            'default' => $_SESSION['usuario']['idusuario'],
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class usuarioperiodoTable extends Table
{
    function usuarioperiodoTable()
    {
        $this->Table('usuarioperiodo');
        $this->title = 'Periodos';
        $this->key = 'idusuarioperiodo';
        $this->addColumn('idusuarioperiodo', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('usuarioperiodo', 'int', 0, 0, 0, 'Periodo');
        $this->addColumn('idusuario', 'int', 0, 0, 'usuario', 'Usuario');
        $this->addColumn('aprobado', 'bool', 0, 0, 0, 'Aprobado');
        $this->addColumn('solicitado', 'bool', 0, 0, 0, 'Solicitado');
        $this->addColumn('transactionid', 'varchar', 25, 0, 0, '# transaccion');
        $this->addColumn('ordenid', 'varchar', 25, 0, 0, '# transaccion');
        if(ADMIN === true)
            $this->addColumn('creacion', 'datetime', 0, 0, 0, 'Fecha de creacion');
        else
            $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha de creacion');
    }
}
class palabraTable extends Table
{
    function palabraTable()
    {
        $this->Table('palabra');
        $this->key = 'idpalabra';
        $this->title = 'Palabras';
        $this->order = 'palabra';
        $this->maxrows = 15;
        $this->addColumn('idpalabra', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('palabra', 'varchar', 80, 0, 0, 'Palabra');
        $this->addColumn('peso', 'int', 0, 0, 0, 'Peso(0-100)');
        $this->addColumn('fecha', 'auto', 0, 0, 0, 'Agregada');
    }
}
class minoticiaTable extends Table
{
    function minoticiaTable()
    {
        $this->Table('minoticia');
        $this->title = 'Mi Noticia';
        $this->order = 'creacion DESC, orden DESC';
        $this->key = 'idminoticia';
        $this->maxcols = 8;
        $this->maxrows = 10;
        $this->detail = 'creditominoticia';
        $this->cache = array(
            'minoticia|portada|',
            'minoticia|comentarios',
            'minoticia|minoticia'
        );
        $this->addColumn('idminoticia', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idseccion', 'int', 0, 0, 'seccion', '<span class="required">Sección*</span>');
        $this->addColumn('antetitulo', 'varchar', 100, 0, 0, 'Antetitulo');
        $this->addColumn('minoticia', 'varchar', 255, 0, 0, '<span class="required">Titulo*</span>');
        $this->addColumn('subtitulo', 'varchar', 100, 0, 0, 'Subtitulo');
        $this->addColumn('ubicacion', 'char', 1, 0, 0, 'Ubicacion', array(
            'arr_values' => array(
                'L' => 'Izquierda',
                'M' => 'Centro',
                'S' => 'Slide',
                'C' => 'Columna del dia'
            )
        ));
        $this->addColumn('intro', 'text', 0, 0, 0, 'Intro');
        $this->addColumn('resumen', 'text', 0, 0, 0, 'Resumen');
        $this->addColumn('texto', 'xhtml', 0, 0, 0, '<span class="required">Texto*</span>', array(
            'style' => 'width:700px;height:300px;'
        ));
        $this->addColumn('ultimahora', 'bool', 0, 0, 0, '?~Zltim Hora?');
        $this->addColumn('claves', 'varchar', 255, 0, 0, 'Etiquetas', array(
            'autocomplete' => true,
            'autocomplete_tb' => 'clave'
        ));
        $this->addColumn('estado', 'varchar', 1, 0, 0, 'Estado', array(
            'arr_values' => array(
                'A' => 'Publicad@',
                'D' => 'Borrador',
                'P' => 'Pendiente a Revisión'
            )
        ));
        $this->addColumn('orden', 'int', 0, 0, 0, 'Orden');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('destacado', 'bool', 0, 0, 0, 'Destacado?');
        $this->addColumn('enportada', 'bool', 0, 0, 0, 'En portada');
        $this->addColumn('presentar', 'varchar', 1, 0, 0, 'Presentar');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idautmn', 'int', 0, 0, 0, 'Enviada por');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'na_usuario.usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
        $this->addColumn('(SELECT count(idcomentariominoticia) FROM comentariominoticia WHERE idminoticia= minoticia.idminoticia AND estado=\'A\') AS comentarios', 'external');
        $this->addColumn('raiting_1', 'auto', 0, 0, 0, 'Raiting 1');
        $this->addColumn('raiting_2', 'auto', 0, 0, 0, 'Raiting 2');
        $this->addColumn('raiting_3', 'auto', 0, 0, 0, 'Raiting 3');
        $this->addColumn('raiting_4', 'auto', 0, 0, 0, 'Raiting 4');
        $this->addColumn('raiting_5', 'auto', 0, 0, 0, 'Raiting 5');
    }
}
class creditominoticiaTable extends Table
{
    function creditominoticiaTable()
    {
        $this->Table('creditominoticia');
        $this->title = 'Credito';
        $this->order = 'orden,idcreditominoticia';
        $this->key = 'idcreditominoticia';
        $this->maxcols = 8;
        $this->is_detail = true;
        $this->addColumn('idcreditominoticia', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idminoticia', 'int', 0, 0, 'minoticia', 'Mi Noticia');
        $this->addColumn('idautor', 'int', 0, 0, 'autor', '<span class="required">Autor*</span>');
    }
}
class comentariominoticiaTable extends Table
{
    function comentariominoticiaTable()
    {
        $this->Table('comentariominoticia');
        $this->title = 'Comentarios';
        $this->order = 'creacion DESC';
        $this->key = 'idcomentariominoticia';
        $this->maxrows = 5;
        $this->addColumn('idcomentariominoticia', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idminoticia', 'int', 0, 0, 'minoticia', 'Mi Noticia');
        $this->addColumn('nombre', 'varchar', 50, 0, 0, 'Nombre');
        $this->addColumn('email', 'varchar', 50, 0, 0, 'Email');
        $this->addColumn('web', 'varchar', 300, 0, 0, 'Página Web');
        $this->addColumn('comentariominoticia', 'text', 0, 0, 0, 'Texto');
        $this->addColumn('estado', 'varchar', 0, 0, 0, 'Estado', array(
            'arr_values' => array(
                'P' => 'en Revisión',
                'B' => 'Bloqueado',
                'A' => 'Aprobado'
            )
        ));
        $this->addColumn('idusuario', 'int', 0, 0, 'usuario', 'Usuario', array(
            'readonly' => true
        ));
        $this->addColumn('ip', 'auto', 0, 0, 0, 'IP', array(
            'default' => $_SERVER['REMOTE_ADDR']
        ));
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
    }
}
class galeriaminoticiaTable extends Table
{
    function galeriaminoticiaTable()
    {
        $this->Table('galeriaminoticia');
        $this->cache = array(
            'minoticia|galeriasminoticia'
        );
        $this->title = 'Galerias Mi Noticia';
        $this->order = 'idgaleriaminoticia DESC';
        $this->key = 'idgaleriaminoticia';
        $this->addColumn('idgaleriaminoticia', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('galeriaminoticia', 'varchar', 50, 0, 0, '<span class="required">Título*</span>');
        $this->addColumn('descripcion', 'text', 0, 0, 0, 'Descripción');
        $this->addColumn('claves', 'varchar', 255, 0, 0, 'Etiquetas', array(
            'autocomplete' => true,
            'autocomplete_tb' => 'clave'
        ));
        $this->addColumn('idusuario', 'int', 0, 0, 'usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('usuario.nombre', 'external');
        $this->addColumn('usuario.apellido', 'external');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('(SELECT count(idcomentariogaleria) FROM comentariogaleria WHERE idgaleriaminoticia= galeriaminoticia.idgaleriaminoticia AND estado=\'A\') AS comentarios', 'external');
        $this->addColumn('estado', 'varchar', 0, 0, 0, 'Estado', array(
            'arr_values' => array(
                'A' => 'Publicad@',
                'D' => 'Borrador',
                'P' => 'Pendiente a Revisión'
            )
        ));
        $this->addColumn('(SELECT count(idcomentariogaleria) FROM comentariogaleria WHERE idgaleriaminoticia=galeriaminoticia.idgaleriaminoticia AND estado=\'A\') AS comentarios', 'external');
        $this->addColumn('raiting_1', 'auto', 0, 0, 0, 'Raiting 1');
        $this->addColumn('raiting_2', 'auto', 0, 0, 0, 'Raiting 2');
        $this->addColumn('raiting_3', 'auto', 0, 0, 0, 'Raiting 3');
        $this->addColumn('raiting_4', 'auto', 0, 0, 0, 'Raiting 4');
        $this->addColumn('raiting_5', 'auto', 0, 0, 0, 'Raiting 5');
    }
}
class fotominoticiaTable extends Table
{
    function fotominoticiaTable()
    {
        $this->Table('fotominoticia');
        $this->title = 'Foto Mi Noticia';
        $this->order = 'creacion DESC';
        $this->key = 'idfotominoticia';
        $this->search = 'credito,claves';
        $this->maxrows = 30;
        $this->addColumn('idfotominoticia', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idminoticia', 'int', 0, 0, 'minoticia', 'Mi Noticia');
        $this->addColumn('fotominoticia', 'image', 0, 0, 0, '<span class="required">Imagen</span>', array(
            'sizes' => '640x200x1,640x300x1,600x400,397x200x1,360x200x1,300x100x1,360x122x1,271x165x1,270x280x1,397x122x1,288x318,232x155,150x100x1,138x90,120x90x1, 155x180x1, 150x150x1,77x77x1,53x82x1,48x48x1'
        ));
        $this->addColumn('texto', 'text', 0, 0, 0, 'Texto');
        $this->addColumn('credito', 'varchar', 500, 0, 0, 0, 'Credito');
        $this->addColumn('claves', 'varchar', 255, 0, 0, 'Etiquetas', array(
            'autocomplete' => true,
            'autocomplete_tb' => 'clave'
        ));
        $this->addColumn('lugartomafoto', 'varchar', 300, 0, 0, 'Lugar');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'na_usuario.usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class galeriafotominoticiaTable extends Table
{
    function galeriafotominoticiaTable()
    {
        $this->Table('galeriafotominoticia');
        $this->title = 'Colección de Imagenes de los Lectores';
        $this->order = 'orden DESC';
        $this->key = 'idgaleriafotominoticia';
        $this->is_detail = true;
        $this->addColumn('idgaleriafotominoticia', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idgaleriaminoticia', 'int', 0, 0, 'galeriaminoticia', 'Galeria');
        $this->addColumn('idfotominoticia', 'int', 0, 0, 'fotominoticia', 'Imagen');
        $this->addColumn('galeriafotominoticia', 'varchar', 50, 0, 0, 'Título');
        $this->addColumn('texto', 'xhtml', 0, 0, 0, 'Texto');
        $this->addColumn('orden', 'int', 0, 0, 0, 'Orden');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class videominoticiaTable extends Table
{
    function videominoticiaTable()
    {
        $this->Table('videominoticia');
        $this->title = 'Videos de los lectores';
        $this->order = 'creacion DESC';
        $this->key = 'idvideominoticia';
        $this->maxrows = 30;
        $this->cache = array(
            'minoticia|videos'
        );
        $this->addColumn('idvideominoticia', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idminoticia', 'int', 0, 0, 'minoticia', 'Mi Noticia');
        $this->addColumn('videominoticia', 'varchar', 255, 0, 0, '<span class="required">Título*</span>');
        $this->addColumn('lugartoma', 'varchar', 300, 0, 0, 'Lugar');
        $this->addColumn('texto', 'xhtml', 0, 0, 0, '<span class="required">Texto*</span>');
        $this->addColumn('url', 'video', 0, 0, 0, '<span class="required">Video</span>');
        $this->addColumn('archivovideo', 'file', 0, 0, 0, '<span class="required">Video</span>');
        $this->addColumn('claves', 'varchar', 255, 0, 0, 'Etiquetas', array(
            'autocomplete' => true,
            'autocomplete_tb' => 'clave'
        ));
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('usuario.nombre', 'external');
        $this->addColumn('usuario.apellido', 'external');
        $this->addColumn('raiting_1', 'auto', 0, 0, 0, 'Raiting 1');
        $this->addColumn('raiting_2', 'auto', 0, 0, 0, 'Raiting 2');
        $this->addColumn('raiting_3', 'auto', 0, 0, 0, 'Raiting 3');
        $this->addColumn('raiting_4', 'auto', 0, 0, 0, 'Raiting 4');
        $this->addColumn('raiting_5', 'auto', 0, 0, 0, 'Raiting 5');
        $this->addColumn('estado', 'varchar', 1, 0, 0, 'Estado', array(
            'arr_values' => array(
                'A' => 'Publicad@',
                'D' => 'Borrador',
                'P' => 'Pendiente a Revisión'
            )
        ));
    }
}
class mediaminoticiaTable extends Table
{
    function mediaminoticiaTable()
    {
        $this->Table('mediaminoticia');
        $this->title = 'Media(Audio)';
        $this->order = 'creacion DESC';
        $this->key = 'idmediaminoticia';
        $this->maxrows = 10;
        $this->addColumn('idmediaminoticia', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('mediaminoticia', 'file', 0, 0, 0, 'MP3');
        $this->addColumn('resumen', 'text', 0, 0, 0, 'Resumen');
        $this->addColumn('credito', 'varchar', 500, 0, 0, 'Credito');
        $this->addColumn('claves', 'varchar', 255, 0, 0, 'Etiquetas', array(
            'autocomplete' => true,
            'autocomplete_tb' => 'clave'
        ));
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('usuario.nombre', 'external');
        $this->addColumn('usuario.apellido', 'external');
        $this->addColumn('authmedia', 'int', 0, 0, 0, 'Usuario');
        $this->addColumn('estado', 'char', 1, 0, 0, 'Estado', array(
            'arr_values' => array(
                'P' => 'en Revisión',
                'B' => 'Bloqueado',
                'A' => 'Aprobado'
            )
        ));
    }
}
class sidebarTable extends Table
{
    function sidebarTable()
    {
        $this->Table('sidebar');
        $this->title = 'Sidebar';
        $this->order = 'idsidebar';
        $this->key = 'idsidebar';
        $this->maxcols = 8;
        $this->is_detail = true;
        $this->addColumn('idsidebar', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idminoticia', 'int', 0, 0, 'minoticia', 'Noticia');
        $this->addColumn('sidebar', 'varchar', 200, 0, 0, "Titulo");
        $this->addColumn('intro', 'text', 0, 0, 0, "Intro");
        $this->addColumn('texto', 'text', 0, 0, 0, "Texto");
    }
}
class relacionadominoticiaTable extends Table
{
    function relacionadominoticiaTable()
    {
        $this->Table('relacionadominoticia');
        $this->title = 'Relacionados';
        $this->order = 'idrelacionadominoticia';
        $this->key = 'idrelacionadominoticia';
        $this->maxcols = 8;
        $this->is_detail = true;
        $this->addColumn('idrelacionadominoticia', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idminoticia', 'int', 0, 0, 'minoticia', 'Noticia');
        $this->addColumn('tipo', 'varchar', 7, 0, 0, "Tipo");
        $this->addColumn('relacionadominoticia', 'varchar', 255, 0, 0, 'Etiqueta');
        $this->addColumn('enlace', 'varchar', 500, 0, 0, "Enlace");
    }
}
class importaciontmpTable extends Table
{
    function importaciontmpTable()
    {
        $this->Table('importaciontmp');
        $this->title = 'Exportacion';
        $this->order = 'idimportaciontmp';
        $this->key = 'idimportaciontmp';
        $this->maxcols = 8;
        $this->is_detail = true;
        $this->addColumn('idimportaciontmp', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idminoticia', 'int', 0, 0, 'minoticia', 'Noticia');
    }
}
class ojociudadanoTable extends Table
{
    function ojociudadanoTable()
    {
        $this->Table('ojociudadano');
        $this->title = 'Ojo ciudadano';
        $this->order = 'creacion DESC';
        $this->key = 'idojociudadano';
        $this->maxrows = 10;
        $this->cache = 'minoticia|ojociudadano';
        $this->addColumn('idojociudadano', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('ojociudadano', 'varchar', 255, 0, 0, '<span class="required">Titulo*</span>');
        $this->addColumn('resumen', 'text', 0, 0, 0, 'Resumen');
        $this->addColumn('texto', 'xhtml', 0, 0, 0, '<span class="required">Texto*</span>', array(
            'style' => 'width:600px;height:300px;'
        ));
        $this->addColumn('claves', 'varchar', 255, 0, 0, 'Etiquetas', array(
            'autocomplete' => true,
            'autocomplete_tb' => 'clave'
        ));
        $this->addColumn('estado', 'varchar', 1, 0, 0, 'Estado', array(
            'arr_values' => array(
                'P' => 'Publicad@',
                'D' => 'Borrador',
                'R' => 'Pendiente a Revisión'
            )
        ));
        $this->addColumn('orden', 'int', 0, 0, 0, 'Orden');
        $this->addColumn('enportada', 'bool', 0, 0, 0, 'En portada');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'na_usuario.usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
        $this->addColumn('raiting_1', 'auto', 0, 0, 0, 'Raiting 1');
        $this->addColumn('raiting_2', 'auto', 0, 0, 0, 'Raiting 2');
        $this->addColumn('raiting_3', 'auto', 0, 0, 0, 'Raiting 3');
        $this->addColumn('raiting_4', 'auto', 0, 0, 0, 'Raiting 4');
        $this->addColumn('raiting_5', 'auto', 0, 0, 0, 'Raiting 5');
        $this->addColumn('(SELECT count(idcomentarioojociudadano) FROM comentarioojociudadano WHERE idojociudadano= ojociudadano.idojociudadano AND estado=\'A\') AS comentarios', 'external');
    }
}
class comentarioojociudadanoTable extends Table
{
    function comentarioojociudadanoTable()
    {
        $this->Table('comentarioojociudadano');
        $this->title = 'Comentarios Seccion Ojo Ciudadano';
        $this->order = 'creacion DESC';
        $this->key = 'idcomentarioojociudadano';
        $this->add = false;
        $this->addColumn('idcomentarioojociudadano', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idojociudadano', 'int', 0, 0, 'ojociudadano', 'Ojo Ciudadano');
        $this->addColumn('nombre', 'varchar', 50, 0, 0, 'Nombre');
        $this->addColumn('email', 'varchar', 50, 0, 0, 'Email');
        $this->addColumn('web', 'varchar', 300, 0, 0, 'Página Web');
        $this->addColumn('comentarioojociudadano', 'text', 0, 0, 0, 'Texto');
        $this->addColumn('estado', 'char', 1, 0, 0, 'Estado', array(
            'arr_values' => array(
                'P' => 'en Revisión',
                'B' => 'Bloqueado',
                'A' => 'Aprobdo'
            )
        ));
        $this->addColumn('idusuario', 'int', 0, 0, 'usuario', 'Usuario', array(
            'readonly' => true
        ));
        $this->addColumn('ip', 'auto', 0, 0, 0, 'IP', array(
            'default' => $_SERVER['REMOTE_ADDR']
        ));
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('(SELECT count(idcomentarioojociudadano) FROM comentarioojociudadano WHERE idojociudadano=ojociudadano.idojociudadano AND estado=\'A\') AS comentarios', 'external');
    }
}
class galeriavideoTable extends Table
{
    function galeriavideoTable()
    {
        $this->Table('galeriavideo');
        $this->title = 'Galerias de Videos';
        $this->order = 'idgaleriavideo DESC';
        $this->key = 'idgaleriavideo';
        $this->detail = 'coleccionvideo';
        $this->addColumn('idgaleriavideo', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('galeriavideo', 'varchar', 50, 0, 0, '<span class="required">Título*</span>');
        $this->addColumn('descripcion', 'text', 0, 0, 0, 'Descripción');
        $this->addColumn('claves', 'varchar', 255, 0, 0, 'Etiquetas', array(
            'autocomplete' => true,
            'autocomplete_tb' => 'clave'
        ));
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
        $this->addColumn('activa', 'bool', 0, 0, 0, 'Activa?');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
    }
}
class coleccionvideoTable extends Table
{
    function coleccionvideoTable()
    {
        $this->Table('coleccionvideo');
        $this->title = 'Colección de Videos';
        $this->order = 'orden DESC';
        $this->key = 'idcoleccionvideo';
        $this->is_detail = true;
        $this->addColumn('idcoleccionvideo', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idgaleriavideo', 'int', 0, 0, 'galeriavideo', 'Galeria Video');
        $this->addColumn('idvideominoticia', 'int', 0, 0, 'videominoticia', 'Video');
        $this->addColumn('coleccionvideo', 'varchar', 50, 0, 0, 'Título');
        $this->addColumn('texto', 'xhtml', 0, 0, 0, 'Texto');
        $this->addColumn('orden', 'int', 0, 0, 0, 'Orden');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class clipcocinandoTable extends Table
{
    function clipcocinandoTable()
    {
        $this->Table('clipcocinando');
        $this->title = 'Clips Cocinando con La Prensa';
        $this->order = 'creacion DESC';
        $this->key = 'idclipcocinando';
        $this->maxrows = 10;
        $this->addColumn('idclipcocinando', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idcategoriaclip', 'int', 0, 0, 'categoriaclip', 'Categoria');
        $this->addColumn('titulo', 'varchar', 255, 0, 0, '<span class="required">Título*</span>');
        $this->addColumn('texto', 'xhtml', 0, 0, 0, '<span class="required">Texto*</span>');
        $this->addColumn('preview', 'image', 0, 0, 0, 'Vista previa', array(
            'sizes' => '122x92'
        ));
        $this->addColumn('clipcocinando', 'varchar', 255, 0, 0, '<span class="required">Video</span>');
        $this->addColumn('duracion', 'varchar', 8, 0, 0, 'Duracion');
        $this->addColumn('claves', 'varchar', 255, 0, 0, 'Etiquetas', array(
            'autocomplete' => true,
            'autocomplete_tb' => 'clave'
        ));
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class categoriaclipTable extends Table
{
    function categoriaclipTable()
    {
        $this->Table('categoriaclip');
        $this->title = 'Categorias de recetas';
        $this->order = 'creacion DESC';
        $this->key = 'idcategoriaclip';
        $this->maxrows = 30;
        $this->addColumn('idcategoriaclip', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('categoriaclip', 'varchar', 20, 0, 0, 'Categoria');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class usuario_ecTable extends Table
{
    function usuario_ecTable()
    {
        $this->Table('usuario_ec');
        $this->title = 'Usuarios E-commerce';
        $this->order = 'usuario_ec, creacion DESC';
        $this->key = 'idusuario_ec';
        $this->addColumn('idusuario_ec', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('usuario_ec', 'varchar', 50, 0, 0, 'Nick');
        $this->addColumn('pass', 'password', 0, 0, 0, 'Clave');
        $this->addColumn('nombre', 'varchar', 60, 0, 0, 'Nombre');
        $this->addColumn('correo', 'varchar', 50, 0, 0, 'Correo');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('telefono', 'varchar', 8, 0, 0, 'Telefono');
        $this->addColumn('departamento', 'varchar', 30, 0, 0, 'Departamento');
        $this->addColumn('direccion', 'varchar', 500, 0, 0, 'Direccion');
    }
}
class itemTable extends Table
{
    function itemTable()
    {
        $this->Table('item');
        $this->title = 'Articulos';
        $this->order = 'item, creacion DESC';
        $this->key = 'iditem';
        $this->addColumn('iditem', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('item', 'varchar', 50, 0, 0, 'Árticulo');
        $this->addColumn('idcoleccion_item', 'int', 0, 0, 'coleccion_item', 'Id');
        $this->addColumn('coleccion_item.coleccion_item', 'external');
        $this->addColumn('descripcion', 'text', 0, 0, 0, 'Descripcion');
        $this->addColumn('existencia', 'int', 0, 0, 0, 'Inventario');
        $this->addColumn('precio', 'float', 0, 0, 0, 'Precio');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('imagen', 'image', 0, 0, 0, 'Imagen', array(
            'sizes' => '122x92,60x87,250x330'
        ));
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class coleccion_itemTable extends Table
{
    function coleccion_itemTable()
    {
        $this->Table('coleccion_item');
        $this->title = 'Colecciones de articulos';
        $this->order = 'coleccion_item, creacion DESC';
        $this->key = 'idcoleccion_item';
        $this->addColumn('idcoleccion_item', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('coleccion_item', 'varchar', 50, 0, 0, 'Colección');
        $this->addColumn('descripcion', 'text', 0, 0, 0, 'Descripcion');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('imagen', 'image', 0, 0, 0, 'Imagen', array(
            'sizes' => '122x92,866x354'
        ));
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class iosTable extends Table
{
    function iosTable()
    {
        $this->Table('ios');
        $this->title = 'iOS';
        $this->key = 'idios';
        $this->addColumn('idios', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('name', 'varchar', 120, 0, 0, 'Nombre');
        $this->addColumn('email', 'varchar', 120, 0, 0, 'Correo Electronico');
        $this->addColumn('device', 'varchar', 6, 0, 0, 'Dispositivo');
        $this->addColumn('udid', 'varchar', 40, 0, 0, 'UDID');
        $this->addColumn('sent', 'auto', 0, 0, 0, 'Fecha de Envio');
        $this->addColumn('handle', 'bool', 0, 0, 0, 'Procesado');
    }
}
class ppoliticoTable extends Table
{
    function ppoliticoTable()
    {
        $this->Table('ppolitico');
        $this->title = 'Partidos politicos';
        $this->key = 'idppolitico';
        $this->order = 'orden';
        $this->addColumn('idppolitico', 'varchar', 16, 1, 0, 'Id');
        $this->addColumn('ppolitico', 'varchar', 200, 0, 0, 'Partido');
        $this->addColumn('presidente', 'varchar', 200, 0, 0, 'Candidato');
        $this->addColumn('orden', 'int', 0, 0, 0, 'Orden');
        $this->addColumn('texto', 'xhtml', 0, 0, 0, 'Texto');
        $this->addColumn('imagen', 'image', 0, 0, 0, 'Imagen', array(
            'sizes' => '90x65,270x195'
        ));
        $this->addColumn('foto', 'image', 0, 0, 0, 'Foto', array(
            'sizes' => '90x65,270x195'
        ));
        $this->addColumn('votos', 'int', 0, 0, 0, 'Votos');
        $this->addColumn('porcentaje', 'numeric', 10.2, 0, 0, 'Porcentaje');
    }
}
class candidatoTable extends Table
{
    function candidatoTable()
    {
        $this->Table('candidato');
        $this->title = 'Candidatos electorales';
        $this->key = 'idcandidato';
        $this->addColumn('idcandidato', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('candidato', 'varchar', 255, 0, 0, '<span class="required">Nombre*</span>');
        $this->addColumn('idppolitico', 'varchar', 16, 0, 'ppolitico', 'Partido');
        $this->addColumn('iddepto', 'varchar', 35, 0, 'depto', 'Departamento electoral');
        $this->addColumn('votos', 'numeric', 10.2, 0, 0, 'Votos');
    }
}
class olimpiadaresultadoTable extends Table
{
    function olimpiadaresultadoTable()
    {
        $this->Table('olimpiadaresultado');
        $this->title = 'resultados olimpiadas';
        $this->key = 'idolimpiadaresultado';
        $this->addColumn('idolimpiadaresultado', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('posicion', 'int', 0, 0, 0, 'posicion');
        $this->addColumn('pais', 'varchar', 200, 0, 0, 'Pais');
        $this->addColumn('deporte', 'varchar', 200, 0, 0, 'deporte');
        $this->addColumn('categoria', 'varchar', 200, 0, 0, 'categoria');
        $this->addColumn('hora', 'date', 0, 0, 0, 'Hora');
        $this->addColumn('atleta', 'xhtml', 0, 0, 0, 'Atletas');
    }
}
class olimpiadamedallaTable extends Table
{
    function olimpiadamedallaTable()
    {
        $this->Table('olimpiadamedalla');
        $this->title = 'medallas olimpiadas';
        $this->key = 'idolimpiadamedalla';
        $this->addColumn('idolimpiadamedalla', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('pais', 'varchar', 200, 0, 0, 'Pais');
        $this->addColumn('oro', 'int', 0, 0, 0, 'oro');
        $this->addColumn('plata', 'int', 0, 0, 0, 'plata');
        $this->addColumn('bronce', 'int', 0, 0, 0, 'bronce');
    }
}
class perfil_olimpiadaTable extends Table
{
    function perfil_olimpiadaTable()
    {
        $this->Table('perfil_olimpiada');
        $this->title = 'Atletas Nicas';
        $this->key = 'idperfil_olimpiada';
        $this->addColumn('idperfil_olimpiada', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('perfil_olimpiada', 'varchar', 200, 0, 0, 'Atleta');
        $this->addColumn('foto', 'image', 0, 0, 0, 'Foto', array(
            'sizes' => '90x65,270x195'
        ));
        $this->addColumn('uri', 'varchar', 32, 0, 0, '<span class="required">URI*</span>', array(
            'source' => 'region',
            'apply_funct_js' => 'friendly_url'
        ));
        $this->addColumn('descripcion', 'xhtml', 0, 0, 0, 'Descripción');
    }
}
class paginaxsuplementocomercialTable extends Table
{
    function paginaxsuplementocomercialTable()
    {
        $this->Table('paginaxsuplementocomercial');
        $this->key = 'idpaginaxsuplementocomercial';
        $this->order = 'orden';
        $this->title = 'Paginas';
        $this->maxrows = 5;
        $this->addColumn('idpaginaxsuplementocomercial', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idsuplementocomercial', 'int', 0, 0, 'suplementocomercial', 'Suplemento Comercial');
        $this->addColumn('paginaxsuplementocomercial', 'image', 0, 0, 0, 'Página', array(
            'sizes' => '48x48x1,150x150,371x490,1100x2140,1100x1452',
            'paths' => ',,/../public_html/suplementocomercial/pages/' . str_replace('-', '', $_REQUEST['suplementocomercial']) . ',/../public_html/suplementocomercial/pages/' . str_replace('-', '', $_REQUEST['suplementocomercial']) . '/large'
        ));
        $this->addColumn('orden', 'order', 0, 0, 0, 'Orden');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'auto', 0, 0, 'na_usuario', 'Usuario', array(
            'default' => $_SESSION['usuario']['idusuario'],
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
    class suplementocomercialTable extends Table
    {
    function suplementocomercialTable()
    {
        $this->Table('suplementocomercial');
        $this->key = 'idsuplementocomercial';
        $this->order = 'edicion DESC';
        $this->title = 'Suplemento Comercial';
        $this->maxrows = 10;
        $this->addColumn('idsuplementocomercial', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('suplementocomercial', 'date', 0, 0, 0, 'Fecha');
        $this->addColumn('edicion', 'int', 0, 0, 0, 'No. Edición');
        $this->addColumn('preview', 'image', 0, 0, 0, 'Preview', array(
            'sizes' => '228'
        ));
        $this->addColumn('suplementocomercialpdf', 'varchar', 500, 0, 0, 'Nombre PDF');
        $this->addColumn('estado', 'bool', 0, 0, 0, 'Publico?');
        $this->addColumn('presentacion', 'varchar', 1, 0, 0, 'Presentacion');
        $this->addColumn('fechainicio', 'datetime', 0, 0, 0, '<span class="required">Fecha de Apertura*</span>');
        $this->addColumn('fechafin', 'datetime', 0, 0, 0, '<span class="required">Fecha de Cierre*</span>');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'auto', 0, 0, 'na_usuario', 'Usuario', array(
            'default' => $_SESSION['usuario']['idusuario'],
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class lpclubTable extends Table
{
    function lpclubTable()
    {
        $this->Table('lpclub');
        $this->key = 'id';
        $this->order = 'creacion DESC';
        $this->title = 'La Prensa Club Promo';
        $this->maxrows = 10;
        $this->addColumn('nombre', 'varchar', 255, 0, 0, 'Nombre');
        $this->addColumn('correo', 'varchar', 100, 0, 0, 'Correo');
        $this->addColumn('celular', 'varchar', 30, 0, 0, 'Celular');
        $this->addColumn('departamento', 'varchar', 30, 0, 0, 'Departamento');
        $this->addColumn('cedula', 'varchar', 30, 0, 0, 'Cedula');
        $this->addColumn('direccion', 'text', 0, 0, 0, 'Direccion');
        $this->addColumn('otros', 'text', 0, 0, 0, 'Otros');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
    }
}
class encuestapicTable extends Table
{
    function encuestapicTable()
    {
        $this->Table('encuestapic');
        $this->title = 'Votacion Pic Aventuras';
        $this->key = 'idencuestapic';
        $this->order = 'idencuestapic DESC';
        $this->addColumn('idencuestapic', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('encuestapic', 'varchar', 250, 0, 0, 'Titulo encuesta');
        $this->addColumn('semana_encuesta', 'varchar', 25, 0, 0, 'Semana');
        $this->addColumn('fecha_inicio', 'datetime', 0, 0, 0, '<span class="required">Fecha de Apertura*</span>');
        $this->addColumn('fecha_fin', 'datetime', 0, 0, 0, '<span class="required">Fecha de Cierre*</span>');
        $this->addColumn('cerrada', 'bool', 0, 0, 0, 'Cerrar encuesta?');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha creacion');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'default' => $_SESSION['usuario']['idusuario'],
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
class opcionespicTable extends Table
{
    function opcionespicTable()
    {
        $this->Table('opcionespic');
        $this->title = 'Opciones Encuesta Fotos';
        $this->key = 'idopcionespic';
        $this->order = 'votos DESC';
        $this->is_detail = true;
        $this->addColumn('idopcionespic', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idencuestapic', 'int', 0, 0, 'encuestapic', 'Encuesta');
        $this->addColumn('titulo', 'varchar', 100, 0, 0, 'Titulo foto');
        $this->addColumn('descripcion', 'xhtml', 0, 0, 0, 'Descripcion foto');
        $this->addColumn('opcionespic', 'image', 0, 0, 0, 'Foto', array(
            'sizes' => '640x200x1,640x300x1,600x400,397x200x1,300x100x1,360x122x1,271x165x1,270x280x1,397x122x1,288x318,232x155,150x100x1,138x90,120x90x1,150x150x1,77x77x1,53x82x1,48x48x1,1024x1024'
        ));
        $this->addColumn('votos', 'auto', 0, 0, 0, 'Resultado');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}

/*
 * Score board
 */
class scoreboardTable extends Table
{
    function scoreboardTable()
    {
        $this->Table('scoreboard');
        $this->title = 'Marcador de Partidos';
        $this->key = 'idscoreboard';
        $this->order = 'idscoreboard DESC';
        $this->is_detail = true;
        $this->addColumn('idopcionespic', 'serial', 0, 1, 0, 'Id');
        $this->addColumn('idencuestapic', 'int', 0, 0, 'encuestapic', 'Encuesta');
        $this->addColumn('titulo', 'varchar', 100, 0, 0, 'Titulo foto');
        $this->addColumn('descripcion', 'xhtml', 0, 0, 0, 'Descripcion foto');
        $this->addColumn('opcionespic', 'image', 0, 0, 0, 'Foto', array(
            'sizes' => '640x200x1,640x300x1,600x400,397x200x1,300x100x1,360x122x1,271x165x1,270x280x1,397x122x1,288x318,232x155,150x100x1,138x90,120x90x1,150x150x1,77x77x1,53x82x1,48x48x1,1024x1024'
        ));
        $this->addColumn('votos', 'auto', 0, 0, 0, 'Resultado');
        $this->addColumn('creacion', 'auto', 0, 0, 0, 'Fecha Creación:');
        $this->addColumn('idusuario', 'int', 0, 0, 'na_usuario', 'Usuario', array(
            'display' => 'usuario'
        ));
        $this->addColumn('na_usuario.nombre', 'external');
        $this->addColumn('na_usuario.apellido', 'external');
    }
}
