FROM node as base

WORKDIR /app

COPY package*.json .

# Build
FROM base AS development

ENV NODE_ENV=development
ENV PATH node_modules/.bin:$PATH

COPY . .

RUN npm run build

# Release
FROM base AS production

ENV NODE_ENV=production

COPY --from=development /app/node_modules ./node_modules
COPY --from=development /app/dist ./dist
COPY --from=development /app/src ./src
COPY --from=development /app/views ./views
# COPY --from=development /app/public ./public

CMD npm run start