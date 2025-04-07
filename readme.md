<br/>
<p align="center">
    <img src="./public/logos/Logo.svg"/>
</p>

## Fluxo de Trabalho com Git Flow

Este projeto segue o modelo Git Flow. As principais branches são:

- `main`: Contém o código estável e em produção.
- `dev`: Contém as últimas alterações aprovadas.
- `feature/nome-da-feature`: Para desenvolver novas funcionalidades.
- `hotfix/nome-do-hotfix`: Para corrigir bugs em produção.

### Criando uma Nova Feature

1. Atualize sua branch `develop`:
   ```sh
   git checkout develop
   git pull upstream develop

2. Crie uma nova branch para sua funcionalidade:
   ```sh
   git checkout -b feature/nome-da-feature

3. Implemente suas mudanças e faça commits:
   ```sh
   git add .
   git commit -m "Descrição das mudanças"

4. Envie sua branch para o GitHub:
    ```sh
    git push origin feature/nome-da-feature


### Após aprovação, o PR será mesclado. Se precisar fazer mais alterações, atualize sua branch e reenvie o PR.
### Reviewers de PR's
- Guilherme Freitas
- Guilherme Montalvão