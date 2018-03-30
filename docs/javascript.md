## Working with Javascript

Vitae NET uses a fair amount of Javascript as well as PHP. Javascript is used
to handle scanning barcodes, and for dynamic components including the
medication, patient, MAR, and assessment creation and edit forms. We also use
Javascript to test this code. The code is located in the standard Laravel
directory, `resources/assets/js`, and the tests are located in
`tests/Javascript`. Much of the Javascript is written using
[ES2015](https://babeljs.io/learn-es2015) features, like `let` and the arrow
syntax for functions which you may not be familiar with, but good resources for
these features exist online, and one is linked in this document.

### Setup

If you are working on Javascript, there are a few steps you'll need to do to
get things working. First, you'll need to install dependencies with `npm`:

```sh
npm install
```

Then, after working on any Javascript, you'll need to regenerate the `public/app.js`
file. This also applies to editing any CSS in `resources/assets/sass`.

```sh
npm run dev
```

If you're fixing a bug or otherwise need access to console logs, you should run
the `dev` version.

```sh
npm run prod
```

If you're done fixing something or just need to update `app.js`, you should run
the `prod` version. **You should commit the prod version of these files for
less cluttered diffs.**

We use the following libraries in Vitae NET:

### Components

We use [Vue.js](https://vuejs.org) for dynamic, client-side components. They
are used to handle creating and editing models. The Vue.js documentation is an
excellent resource if you are working on the components.

### jQuery

We use [jQuery](https://jquery.com) for some button handlers, modal windows,
and for scanning barcodes.

### Axios

We use the [axios](https://github.com/axios/axios) library for doing AJAX calls
during barcode scanning.

### Testing

For testing, we use [mocha](https://mochajs.org) as our test runner, and 
[expect](https://facebook.github.io/jest/docs/en/expect.html) to handle
assertions. For testing Vue components we use
[vue-test-utils](https://vue-test-utils.vuejs.org/en/).

To run the tests, run

```sh
npm run test
```

in the terminal. When you've finished testing locally, run `npm run prod`
again, because the test runner modifies a file in `public/` and this needs to
be fixed before committing.
