import { ApolloServer } from '@apollo/server'; // For setup of server
import { startStandaloneServer } from '@apollo/server/standalone'; // For listening

// DB
import db from './_db.js'

// Types / Schema
import {typeDefs} from './schema.js'

const resolvers = {
    Query: {
        games() {
            return db.games
        },
        authors() {
            return db.authors
        },
        reviews() {
            return db.reviews
        }
    }
}


// server object setup
const server = new ApolloServer({

     typeDefs, // definitions of types of data. Cornerstone of a schema 
     resolvers // how to respond to diffierent queries
})

const {url} = await startStandaloneServer(server, {
    listen: {port:4000}
})

console.log('Server ready at port', 4000)