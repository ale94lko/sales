import { createApp } from 'vue'
import App from '@/App.vue'
import router from '@/router'
import store from '@/store'
import { initializeApp } from 'firebase/app'

createApp(App)
  .use(store)
  .use(router)
  .mount('#app')

const firebaseConfig = {
  apiKey: 'AIzaSyBH0PJiIV0PCuNJrciiYFgHQoL6VUbHBGM',
  authDomain: 'sales-dev-server.firebaseapp.com',
  projectId: 'sales-dev-server',
  storageBucket: 'sales-dev-server.appspot.com',
  messagingSenderId: '848766948653',
  appId: '1:848766948653:web:87bebf559647d1a6172fa4',
};

// eslint-disable-next-line no-unused-vars
const app = initializeApp(firebaseConfig);
