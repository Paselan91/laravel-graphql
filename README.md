# Laravel GraphQL Sample
### install
```zsh
make init
```

### GraphQL playground
- create db & seeds
```zsh
make fresh
```
- open playground  
http://localhost/graphql-playground

- query request
```graphql
query {
  fetchAllUser {
    id
    name
    posts {
      id
      title
    }
  }
}
```

- response
```json
{
  "data": {
    "fetchAllUser": [
      {
        "id": "1",
        "name": "Anne Cummings",
        "posts": [
          {
            "id": "1",
            "title": "Prof."
          },
          {
            "id": "2",
            "title": "Ms."
          },
          {
            "id": "3",
            "title": "Dr."
          },
          {
            "id": "4",
            "title": "Dr."
          }
        ]
      },
      {
        "id": "2",
        "name": "Dr. Winnifred Parisian",
        "posts": [
          {
            "id": "5",
            "title": "Dr."
          }
        ]
      }
    ]
  }
}
```
