// Variáveis globais
let currentQuestion = 0;
const questions = document.querySelectorAll('.question-container');
const totalQuestions = document.querySelectorAll('.question-container:not(:last-child)').length;

// Atualiza a barra de progresso
function updateProgressBar() {
    const progressBar = document.getElementById('progress-bar');
    const progress = ((currentQuestion + 1) / totalQuestions) * 100;
    progressBar.style.width = `${progress}%`;
}

// Mostra uma pergunta específica
function showQuestion(index) {
    // Esconde todas as perguntas
    questions.forEach(q => q.classList.remove('active'));
    
    // Mostra a pergunta atual (garante que o índice não ultrapasse o limite)
    index = Math.min(index, questions.length - 1);
    questions[index].classList.add('active');
    currentQuestion = index;
    
    // Atualiza a barra de progresso
    const progressBar = document.getElementById('progress-bar');
    if (index < totalQuestions) {
        const progress = ((index + 1) / totalQuestions) * 100;
        progressBar.style.width = `${progress}%`;
    } else {
        progressBar.style.width = '100%';
    }
}

// Avança para a próxima pergunta
function nextQuestion() {
    // Pega o container atual e os botões de rádio
    const currentContainer = questions[currentQuestion];
    const radioButtons = currentContainer.querySelectorAll('input[type="radio"]');
    
    // Se estamos em uma questão (não no feedback)
    if (radioButtons.length > 0) {
        let isAnswered = Array.from(radioButtons).some(radio => radio.checked);
        
        if (!isAnswered) {
            alert('Por favor, selecione uma opção antes de continuar.');
            return;
        }
    }

    // Avança para a próxima questão se existir
    if (currentQuestion < questions.length - 1) {
        showQuestion(currentQuestion + 1);
    }
}

// Volta para a pergunta anterior
function previousQuestion() {
    if (currentQuestion > 0) {
        showQuestion(currentQuestion - 1);
    }
}

// Mostra o campo de feedback
function showFeedback() {
    // Vai para o último container (feedback)
    showQuestion(questions.length - 1);
}

// Inicialização
document.addEventListener('DOMContentLoaded', function () {
    showQuestion(0);

    // Adiciona efeito de hover nos botões da escala
    const scaleButtons = document.querySelectorAll('.scale-button');
    scaleButtons.forEach(button => {
        button.addEventListener('mouseover', function () {
            this.style.transform = 'scale(1.1)';
        });
        button.addEventListener('mouseout', function () {
            if (!this.previousElementSibling.checked) {
                this.style.transform = 'scale(1)';
            }
        });
    });

    // Adiciona validação ao formulário
    const form = document.getElementById('avaliacaoForm');
    form.addEventListener('submit', function (e) {
        const allQuestions = document.querySelectorAll('.question-container');
        let unansweredQuestion = -1;

        // Verifica cada questão (exceto o último container que é o feedback)
        for (let i = 0; i < (totalQuestions - 1); i++) {
            const radioButtons = allQuestions[i].querySelectorAll('input[type="radio"]');
            const isAnswered = Array.from(radioButtons).some(radio => radio.checked);
            
            if (!isAnswered) {
                unansweredQuestion = i;
                break;
            }
        }

        if (unansweredQuestion >= 0) {
            e.preventDefault();
            alert('Por favor, responda a pergunta ' + (unansweredQuestion + 1) + ' antes de enviar.');
            showQuestion(unansweredQuestion);
        }
    });
});
