Развертывание проекта:

`docker build -t test -f .docker/Dockerfile .
`

`docker compose up
`

Для удобства проверки работы запуск миграций запускается при старте контейнера.

**NB: В реальном production окружении автозапуск миграций при старте контейнера необходимо отключить** 

**GET: /guests**

    ответ:
    
    {
    
        status: string,
        data: {
            id: integer,
            name: string,
            surname: string,
            phone: string,
            email: string,
            country: string
        }[]

    }

**POST: /guests/store**

    запрос:
    
    {
    
        name: string,
        surname: string,
        phone: string,
        email: string,
        country: string|null
    }
    
    ответ:
    
    {
    
        status: string,
        data: null
    }


**POST: /guests/update**

    запрос:
    
    {
    
        id: integer,
        name: string,
        surname: string,
        phone: string,
        email: string,
        country: string|null
    }
    
    ответ:
    
    {
    
        status: string,
        data: null
    }

**GET: /guests/{id}**

    ответ:
    
    {
    
        status: string,
        data: {
            id: integer,
            name: string,
            surname: string,
            phone: string,
            email: string,
            country: string|null
        }
    }

**DELETE: /guests/{id}**

ответ:

    {
    
        status: string,
        data: null
    }
