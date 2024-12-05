import routes from '../routes';

export default function () {
  const dataRoute = document.querySelector('.app').dataset.route;
  if (dataRoute && routes.get(dataRoute)) {
    const App = routes.get(dataRoute);
    new App();
  }
}
