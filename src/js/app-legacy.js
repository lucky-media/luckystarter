// Import all stable polyfills
import 'core-js/stable';

// Alternateively load all polyfills
//import 'core-js';
import 'regenerator-runtime/runtime';

// Load extra polyfills required by legacy browsers before importing app.js

import './app.js';
