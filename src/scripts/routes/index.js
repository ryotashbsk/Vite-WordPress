const files = import.meta.glob('./*.js', { eager: true });
const modules = new Map();
for (const key in files) {
  const name = key.replace(/(\.\/|\.js)/g, '');
  const module = files[key].default;

  if (name !== 'index') {
    modules.set(name, module);
  }
}

export default modules;
