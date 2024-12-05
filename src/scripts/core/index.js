import routes from '../routes';

export default function () {
  const dataRoute = document.documentElement.dataset.route;
  if (dataRoute && routes.get(dataRoute)) {
    const App = routes.get(dataRoute);
    new App();
  }
}
