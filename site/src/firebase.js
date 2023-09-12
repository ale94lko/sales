import { firebase } from 'firebase'

const firebaseConfig = {
  apiKey: 'AIzaSyBH0PJiIV0PCuNJrciiYFgHQoL6VUbHBGM',
  authDomain: 'sales-dev-server.firebaseapp.com',
  projectId: 'sales-dev-server',
  storageBucket: 'sales-dev-server.appspot.com',
  messagingSenderId: '848766948653',
  appId: '1:848766948653:web:87bebf559647d1a6172fa4',
};

export default firebase.initializeApp(firebaseConfig);
