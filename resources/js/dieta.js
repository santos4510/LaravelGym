class DietaDefinir {
    constructor() {
        this.refeicoes = {
            cafeDaManha: {
                proteinas: ["Ovos"],
                carboidratos: ["Pão integral"],
                vegetais: ["Espinafre"],
                bebidas: ["Café sem açúcar"],
                gorduras: []
            },
            almoco: {
                proteinas: ["Peito de frango"],
                carboidratos: ["Batata-doce"],
                vegetais: ["Brócolis"],
                gorduras: ["Azeite"],
                bebidas: []
            },
            lanche: {
                proteinas: ["Whey protein"],
                carboidratos: [],
                frutas: ["Banana"],
                gorduras: ["Pasta de amendoim"],
                bebidas: []
            },
            jantar: {
                proteinas: ["Filé de peixe grelhado"],
                carboidratos: ["Quinoa"],
                vegetais: ["Salada"],
                gorduras: [],
                bebidas: []
            }
        };
    }
}


class DietaGigante {
    constructor() {
        this.refeicoes = {
            cafeDaManha: {
                proteinas: ["Ovos"],
                carboidratos: ["Pão integral", "Aveia"],
                gorduras: ["Pasta de amendoim"],
                frutas: ["Banana"],
                bebidas: ["Vitamina de banana com aveia"],
                vegetais: []
                },
            almoco: {
                proteinas: ["Carne vermelha magra"],
                carboidratos: ["Arroz", "Feijão"],
                vegetais: ["Salada"],
                gorduras: [],
                frutas: [],
                bebidas: []
            },
            lanche: {
                proteinas: ["Frango desfiado"],
                carboidratos: ["Batata-doce"],
                gorduras: ["Azeite"],
                vegetais: [],
                frutas: [],
                bebidas: []
            },
            jantar: {
                proteinas: ["Atum"],
                carboidratos: ["Macarrão integral"],
                vegetais: ["Brócolis"],
                gorduras: [],
                frutas: [],
                bebidas: []
            },
        };
    }
}

class DietaManterPeso {
    constructor() {
        this.refeicoes = {
            cafeDaManha: {
                proteinas: ["Queijo branco", "Ovo"],
                carboidratos: ["Pão integral"],
                gorduras: [],
                frutas: [],
                vegetais: [],
                bebidas: ["Café sem açúcar"]
            },
            almoco: {
                proteinas: ["Peito de frango"],
                carboidratos: ["Arroz integral", "Feijão"],
                vegetais: ["Salada"],
                gorduras: ["Azeite"],
                frutas: [],
                bebidas: []
            },
            lanche: {
                proteinas: ["Iogurte natural"],
                carboidratos: ["Aveia"],
                frutas: ["Frutas variadas"],
                gorduras: [],
                vegetais: [],
                bebidas: []
            },
            jantar: {
                proteinas: ["Ovo", "Queijo cottage"],
                carboidratos: [],
                vegetais: ["Legumes"],
                gorduras: [],
                frutas: [],
                bebidas: []
            }
        };
    }
} 