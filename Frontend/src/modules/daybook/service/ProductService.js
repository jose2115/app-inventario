

// Objeto vacío
export const data = {};

// Agregar más datos al objeto
data.nuevoObjeto = {
  propiedad1: 'valor1',
  propiedad2: 'valor2'
};

// Agregar función para agregar un nuevo objeto
export function agregarNuevoObjeto(nuevoObjeto) {
  data.otroNuevoObjeto = nuevoObjeto;
}

// Agregar función para obtener todos los objetos
export function obtenerTodosLosObjetos() {
  return Object.values(data);
}

