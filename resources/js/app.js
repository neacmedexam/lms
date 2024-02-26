import './bootstrap';


import Editor from '@toast-ui/editor';
// import 'codemirror/lib/codemirror.css';
import '@toast-ui/editor/dist/toastui-editor.css';

const editor = new Editor({
  el: document.querySelector('#editor'),
  height: '300px',
  initialEditType: 'markdown',
  placeholder: 'Enter your message here!',
  
})

document.querySelector('#createPostForm').addEventListener('submit', e => {
  e.preventDefault();
  document.querySelector('#content').value = editor.getMarkdown();
  e.target.submit();
 
});


