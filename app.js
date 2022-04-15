import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor';
import Essentials from '@ckeditor/ckeditor5-essentials/src/essentials';
import Paragraph from '@ckeditor/ckeditor5-paragraph/src/paragraph';
import Bold from '@ckeditor/ckeditor5-basic-styles/src/bold';
import Italic from '@ckeditor/ckeditor5-basic-styles/src/italic';
import SimpleUploadAdapter from '@ckeditor/ckeditor5-upload/src/adapters/simpleuploadadapter';
import Alignment from '@ckeditor/ckeditor5-alignment/src/alignment'; 

import Image from '@ckeditor/ckeditor5-image/src/image';
import ImageToolbar from '@ckeditor/ckeditor5-image/src/imagetoolbar';
import ImageCaption from '@ckeditor/ckeditor5-image/src/imagecaption';
import ImageStyle from '@ckeditor/ckeditor5-image/src/imagestyle';
import ImageResize from '@ckeditor/ckeditor5-image/src/imageresize';


// ClassicEditor
//     .create( document.querySelector( '#editor' ), {
//         plugins: [ Essentials, Paragraph, Bold, Italic, Alignment, Image, ImageToolbar, ImageCaption, ImageStyle, ImageResize ],
//         // toolbar: [ 'bold', 'italic', 'undo', 'redo', 'selectAll', 'alignment','imageTextAlternative' ],
//         image: {
//             toolbar: [
//                 'imageStyle:block',
//                 'imageStyle:side',
//                 '|',
//                 'toggleImageCaption',
//                 'imageTextAlternative',
//             ]
//         }
//     } )
//     .then( editor => {
//         console.log( 'Editor was initialized', editor );
//         console.log(Array.from( editor.ui.componentFactory.names() ));

//     } )
//     .catch( error => {
//         console.error( error.stack );
//     } );

