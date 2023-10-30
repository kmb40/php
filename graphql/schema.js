export const typeDefs = `#graphql
#! makes an item required
    type Game {
        id: ID!
        title: String!
        platform: [String]! #array
    }
    type Review {
        id: ID!
        rating: Int!
        content: String!
    }
    type Author {
        id: ID!
        name: String!
        verified: Boolean!
    }
    type Query {
       reviews: [Review] 
       games: [Game]
       authors: [Author]
    }
`