# Containers
**Objective:** Build fundamental instructions for containerizing an application and making it portable to any remote repo or registry.

**Prerequisite:**
Docker needs to be installed. [Docker Desktop](https://www.docker.com/products/docker-desktop/) serves the need.
**Note:** Docker Desktop must be running in order to use docker at CLI (this includes VSCode).

##### Images and Containers Explained
Ref - https://www.knowledgehut.com/blog/devops/docker-vs-container#why-docker-containers-are-useful?%C2%A0 
Ref - https://stackoverflow.com/questions/23735149/what-is-the-difference-between-a-docker-image-and-a-container 
- Images are read only snapshots of applications.
- Containers are realtime running instances of an image.

1. Within the root directory of the app, create a file named `Dockerfile`.
2. Populate it with the following code:
```
# syntax=docker/dockerfile:1

FROM node:18-alpine
WORKDIR /app
COPY . .
RUN yarn install --production
CMD ["node", "src/index.js"]
EXPOSE 3000
```
3. Convert the code into an image with the command `docker build -t <name of the app lowercase> .`.
4. You have created an image.
5. Run the image locally using the `docker run -dp 127.0.0.1:3000:3000 <name of the app lowercase>` command.
**Note:** If other servers or apps are occupying the port, then there may be errors or no browser session launched.
6. Push the image to another repository:
- DockerHub:
    * Create a Repository at https://hub.docker.com.
    * In the local environment, login to docker with `docker login -u <docker username>`.
    * Tag the local image `docker tag <local docker image name> <docker username>/<docker repo name>`.
    * Push local image to Docker Hub using `docker push <docker username>/<docker repo name>`.
7. To remove images use `docker rmi <image id>`. Gather the image ids of all images using `docker images`

**Issue**
WHen attempting to check docker version - Cannot connect to the Docker daemon at unix:///var/run/docker.sock. Is the docker daemon running?

**Resolution**
Make sure Docker Desktop is started.