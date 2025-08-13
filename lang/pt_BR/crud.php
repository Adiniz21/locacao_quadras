<?php

return [
    'common' => [
        'actions' => 'Ações',
        'create' => 'Criar',
        'edit' => 'Editar',
        'update' => 'Atualizar',
        'new' => 'Novo',
        'cancel' => 'Cancelar',
        'attach' => 'Anexar',
        'detach' => 'Desanexar',
        'save' => 'Salvar',
        'delete' => 'Excluir',
        'delete_selected' => 'Excluir selecionados',
        'search' => 'Buscar...',
        'back' => 'Voltar ao início',
        'are_you_sure' => 'Tem certeza?',
        'no_items_found' => 'Nenhum item encontrado',
        'created' => 'Criado com sucesso',
        'saved' => 'Salvo com sucesso',
        'removed' => 'Removido com sucesso',
        'please_select' => 'Por favor selecione',
    ],

    'auth' => [
        'login' => 'Entrar',
        'logout' => 'Sair',
        'register' => 'Registrar',
        'email' => 'E-mail',
        'password' => 'Senha',
        'confirm_password' => 'Confirmar Senha',
        'remember_me' => 'Lembrar-me',
        'forgot_password' => 'Esqueceu sua senha?',
    ],

    'users' => [
        'name' => 'Usuários',
        'index_title' => 'Lista de Usuários',
        'new_title' => 'Novo Usuário',
        'create_title' => 'Criar Usuário',
        'edit_title' => 'Editar Usuário',
        'show_title' => 'Exibir Usuário',
        'inputs' => [
            'name' => 'Nome',
            'cpf' => 'CPF',
            'email' => 'E-mail',
            'phone' => 'Telefone',
            'password' => 'Senha',
        ],
    ],

    'all_employees' => [
        'name' => 'Funcionários',
        'index_title' => 'Lista de Funcionários',
        'new_title' => 'Novo Funcionário',
        'create_title' => 'Criar Funcionário',
        'edit_title' => 'Editar Funcionário',
        'show_title' => 'Exibir Funcionário',
        'inputs' => [
            'user_id' => 'Usuário',
            'position' => 'Cargo',
            'salary' => 'Salário',
            'hired_date' => 'Data de Contratação',
        ],
        'placeholders' => [
            'salary' => 'Por favor, informe o salário',
        ],
        'validation' => [
            'salary_gt' => 'O salário deve ser maior que zero.',
            'salary_numeric' => 'Informe um valor numérico válido para o salário.',
            'hired_date_format' => 'A data de contratação deve estar no formato dd/mm/aaaa.',
            'hired_date_not_future' => 'A data de contratação não pode ser no futuro.'
        ],
    ],

    'sports_facilities' => [
        'name' => 'Quadras Esportivas',
        'index_title' => 'Lista de Quadras',
        'new_title' => 'Nova Quadra',
        'create_title' => 'Criar Quadra',
        'edit_title' => 'Editar Quadra',
        'show_title' => 'Exibir Quadra',
        'inputs' => [
            'name' => 'Nome',
            'type' => 'Tipo',
            'capacity' => 'Capacidade',
            'price_per_hour' => 'Preço por Hora',
            'availability' => 'Disponibilidade',
        ],
    ],

    'reservations' => [
        'name' => 'Reservas',
        'index_title' => 'Lista de Reservas',
        'new_title' => 'Nova Reserva',
        'create_title' => 'Criar Reserva',
        'edit_title' => 'Editar Reserva',
        'show_title' => 'Exibir Reserva',
        'inputs' => [
            'user_id' => 'Usuário',
            'facility_id' => 'Quadra',
            'reservation_date' => 'Data da Reserva',
            'start_time' => 'Horário de Início',
            'end_time' => 'Horário de Término',
            'total_price' => 'Preço Total',
            'payment_status' => 'Status do Pagamento',
            'recurrence' => 'Recorrência',
        ],
    ],

    'payments' => [
        'name' => 'Pagamentos',
        'index_title' => 'Lista de Pagamentos',
        'new_title' => 'Novo Pagamento',
        'create_title' => 'Criar Pagamento',
        'edit_title' => 'Editar Pagamento',
        'show_title' => 'Exibir Pagamento',
        'inputs' => [
            'reservation_id' => 'Reserva',
            'amount' => 'Valor',
            'payment_method' => 'Forma de Pagamento',
            'status' => 'Status',
            'transaction_date' => 'Data da Transação',
        ],
    ],

    'dashboard' => [
        'title' => 'Painel de Controle',
        'welcome' => 'Bem-vindo ao painel de controle!',
        'stats' => 'Estatísticas',
        'total_reservations' => 'Total de Reservas',
        'total_revenue' => 'Receita Total',
        'available_facilities' => 'Quadras Disponíveis',
    ],
];
