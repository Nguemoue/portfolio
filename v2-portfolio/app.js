// app.js
const next = require('next');
const { createServer } = require('http');

const dev = false; // en production
const app = next({ dev });
const handle = app.getRequestHandler();

app.prepare().then(() => {
  createServer((req, res) => {
    handle(req, res);
  }).listen(3000, (err) => {
    if (err) throw err;
    console.log('🚀 Next.js app running on http://localhost:3000');
  });
});
